<?php

class ExpertiseController extends Controller
{
    public $layout = '//layouts/page';
    public $pageTitle='Expertise';
    public $modelStatic;
    public $modelTech;

    public function actionIndex()
	{
        $modelStatic = Staticpages::model()->findByAttributes(array('title' => 'Expertise'));
        $modelProjects = Projects::model()->findAll();
        $modelTech = Tech::model()->findAll();
        $modelTitle = Titles::model()->findByAttributes(array('title' => 'Our Expertise'));
        $modelDoc = Documents::model()->findAll();
        $this->render(
            'index',
            array(
                'modelStatic' => $modelStatic,
                'modelProjects' => $modelProjects,
                'modelTech' => $modelTech,
                'modelTitle' => $modelTitle,
                'modelDoc' => $modelDoc,
            ));
	}

    public static function getDoc($id)
    {
        $idDoc = Yii::app()->db->createCommand()
            ->select('id')
            ->from('documents')
            ->where('idTitle = :id', array(':id' => $id))
            ->queryAll();
        if (count($idDoc)==1)
        {
            return $idDoc[0]['id'];
        } else
        {
            return false;
        }

    }
	
	public function actionProjects($tech = '', $tag = '')
	{
        $modelTech = Tech::model()->findByAttributes(array('title' => $tech));

//        if(!empty($tech)){
//            $projects = Yii::app()->db->createCommand()
//                ->select('projects.id, projects.title, projects.description')
//                ->from('projects')
//                ->leftJoin('tech_project', 'tech_project.project_id = projects.id')
//                ->leftJoin('tech', 'tech.id = tech_project.tech_id')
//                ->where('tech.title = :tech', array(':tech' => $tech))
//                ->order('projects.position')
//                ->queryAll();
        if(!empty($tech)){
            $projects = Yii::app()->db->createCommand()
                ->select('projects.id, projects.title, projects.description')
                ->from('projects')
                ->leftJoin('tech', 'tech.id = projects.idTech')
                ->where('tech.title = :tech', array(':tech' => $tech))
                ->order('projects.title')
                ->queryAll();

        }else{
            $projects = Yii::app()->db->createCommand()
                ->select('projects.id, projects.title, projects.description')
                ->from('projects')
                ->leftJoin('tags_projects', 'tags_projects.project_id = projects.id')
                ->leftJoin('tags', 'tags.id = tags_projects.tag_id')
                ->where('tags.title LIKE :tag', array(':tag' => '%'.$tag.'%'))
                ->order('projects.position')
                ->queryAll();
        }
//        $modelPics = ProjectsPics::model()->findByAttributes(array('project_id' => $projects['id']));

        $tagsList = Yii::app()->db->createCommand()
            ->select('tags.title, tags_projects.project_id')
            ->from('tags')
            ->leftJoin('tags_projects', 'tags_projects.tag_id = tags.id')
            ->order('tags.title')
            ->queryAll();

        $this->render('filter', array('projects' => $projects, 'tagsList' => $tagsList, 'modelTech' => $modelTech, ));
	}

}
