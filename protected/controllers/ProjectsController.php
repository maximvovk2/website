<?php

class ProjectsController extends Controller {
    public function actionIndex() {
        $this->render('index', array('tech' => Tech::model()->with(array('projects' => array('order' => 'projects.position')))->findAll(array('order' => 't.position'))));
    }
    public function actionView($project, $tech, $id) {
        if (!trim($project) || !trim($tech) || (int)$id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $prj = Projects::model()->findByPk($id);
        $desiredSkills = '';
        foreach ($prj->tech as $skill) {
            $desiredSkills .= ' ' . $skill->title . ',';
        }
        $desiredSkills = rtrim($desiredSkills, ',');
        $tech = Tech::model()->findByAttributes(array('url' => $tech));
        $projects = $tech->projects;
        $projectOrder = $this->findRecord($prj, $projects);
        $prevUrl = $nextUrl = '';
        if (isset($projects[$projectOrder - 1])) {
            $prevUrl = '/projects/view/project/' . $projects[$projectOrder - 1]->url . '/tech/' . $tech->url . '/id/' . $projects[$projectOrder - 1]->id;
        }
        if (isset($projects[$projectOrder + 1])) {
            $nextUrl = '/projects/view/project/' . $projects[$projectOrder + 1]->url . '/tech/' . $tech->url . '/id/' . $projects[$projectOrder + 1]->id;
        }

        $this->render('view', array(
            'project' => $prj,
            'skills' => $desiredSkills,
            'prevUrl' => $prevUrl,
            'nextUrl' => $nextUrl,
            'techUrl' => $tech->url
        ));
    }

    protected  function findRecord($record, $array) {

        foreach ($array as $id => $row) {
            if ($row->id == $record->id) {
                return $id;
            }
        }
        return false;
    }
}