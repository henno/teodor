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
        $this->tasks = get_all("SELECT * FROM person
                              NATURAL JOIN group_persons
                              NATURAL JOIN `group`
                              JOIN course USING (group_id)
                              NATURAL JOIN `course_tasks`
                              NATURAL JOIN subject
                              JOIN task USING (task_id)
                              NATURAL JOIN task_status
                              WHERE person.person_id={$this->auth->person_id}");
    }

    function view()
    {
        $comments = array();
        $task_id = $this->params[0];

        // Virtual machines
        $vms = new digitalocean_api();
        $this->droplets = $vms->get_all();

        //Delete nonexsisting virtual machines from database
        $this->delete_orphan_virtual_machines($this->droplets);

        $this->task = get_first("SELECT
                                    task.`task_id`,
                                    `task_name`,
                                    `task_text`,
                                    `task_due`,
                                    `task_time_required`,
                                    `task_date_added`,
                                    `person_lastname`,
                                    `uses_virtual_machines`,
                                    `virtual_machine_id`
                                 FROM task
                                 NATURAL JOIN task_status
                                 NATURAL JOIN person
                                 LEFT JOIN person_tasks_statuses s ON s.task_id=task.task_id AND s.person_id = {$this->auth->person_id}
                                 LEFT JOIN virtual_machine v ON v.task_id=task.task_id AND v.person_id = {$this->auth->person_id}
                                 WHERE task.task_id={$task_id}");
        $comments_raw = get_all("SELECT * FROM task_comment
                                 NATURAL JOIN person
                                 WHERE task_id={$task_id}");

        // Rename anynonomous members with comment id
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




        $this->virtual_machines = get_all("SELECT * FROM virtual_machine");
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
            q("DELETE from virtual_machine WHERE virtual_machine_id NOT IN ($exsisting_droplet_ids)");
        } else {
            q("DELETE from virtual_machine");
        }
    }
}