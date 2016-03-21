<?php

/**
 * Created by PhpStorm.
 * User: Malin
 * Date: 2.04.2015
 * Time: 17:17
 */
class tasks extends Controller
{
    function index()
    {
        $this->tasks = get_all("SELECT * FROM persons
                              JOIN group_persons USING(person_id)
                              JOIN groups USING(group_id)
                              JOIN courses USING (group_id)
                              JOIN course_tasks USING(course_id)
                              JOIN subjects USING (subject_id)
                              JOIN tasks USING (person_id)
                              JOIN task_statuses USING(task_status_id)
                              WHERE persons.person_id={$this->auth->person_id}");
    }

    function view()
    {
        $comments = array();
        $task_id = $this->params[0];

        // Virtual machines
        $vms = new digitalocean_api();
        $this->droplets = $vms->get_all();

        //Delete non existing virtual machines from database
        $this->delete_orphan_virtual_machines($this->droplets);

        $this->task = get_first("SELECT
                                    tasks.`task_id`,
                                    `task_name`,
                                    `task_text`,
                                    `task_due`,
                                    `task_time_required`,
                                    `task_date_added`,
                                    `person_lastname`,
                                    `uses_virtual_machines`,
                                    `virtual_machine_id`
                                 FROM tasks
                                 JOIN task_statuses USING (task_status_id)
                                 JOIN persons USING (person_id)
                                 LEFT JOIN person_tasks_statuses s ON s.task_id=tasks.task_id AND s.person_id = {$this->auth->person_id}
                                 LEFT JOIN virtual_machines v ON v.task_id=tasks.task_id AND v.person_id = {$this->auth->person_id}
                                 WHERE tasks.task_id={$task_id}");
        $comments_raw = get_all("SELECT * FROM task_comments
                                 JOIN persons USING (person_id)
                                 WHERE task_id={$task_id}");

        // Rename anonymous members with comment id
        foreach ($comments_raw as $comment) {
            $comments[$comment['task_comment_id']] = $comment;
        }

        // Move comment replies under parent
        foreach ($comments as &$comment) {

            // Check if this comment is a reply
            if ($comment['task_comment_parent_id']) {

                // Copy this comment into its parent's replies array
                $comments[$comment['task_comment_parent_id']]['replies'][] = $comment;

                // Remove this comment from comments array
                unset($comments[$comment['task_comment_id']]);
            }
        }
        $this->comments = $comments;




        $this->virtual_machines = get_all("SELECT * FROM virtual_machines");
        $this->n = 1;
    }

    function create_ajax()
    {

    }

    /**
     * @param $exsisting_droplet_ids
     */
    public function delete_orphan_virtual_machines($exsisting_droplets)
    {
        foreach ($exsisting_droplets as $droplet) {
            $exsisting_droplet_ids[] = $droplet->id;
            $droplet->isReady = true;
        }
        if (!empty($exsisting_droplet_ids)) {
            $exsisting_droplet_ids = implode(',', $exsisting_droplet_ids);
            q("DELETE from virtual_machines WHERE virtual_machine_id NOT IN ($exsisting_droplet_ids)");
        } else {
            q("DELETE from virtual_machines");
        }
    }
}