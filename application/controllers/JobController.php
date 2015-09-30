<?php

class JobController extends Zend_Rest_Controller{
    public function init(){
        $this->_helper->viewRenderer->setNoRender(true);
    }
    public function headAction(){
        $this->getResponse()->setBody(null);
    }

    public function optionsAction(){
        $this->getResponse()->setBody(null);
        $this->getResponse()->setHeader('Allow', 'OPTIONS, HEAD, INDEX, GET, POST, PUT, DELETE');
    }

    public function indexAction(){
        $cursor = Application_Model_Job::all();
        $jobList = array();
        foreach($cursor as $obj){
            $jobList[] = $obj->getJson();
        }
        $this->_helper->json($jobList);
    }

    public function getAction(){
        $jobId = (int) $this->_getParam('id');
        $job = Application_Model_Job::fetchOne(array('id' => $jobId));
        $this->_helper->json($job->getJson());
    }

    public function postAction(){
        $test = array(
            'id' => 6,
            'jobTitle' => 'Test',
            'jobSalary' => 1000,
            'location' => 'Test',
            'contactEmail' => 'test@mail.com',
            'endTime' => new MongoDate(strtotime("2010-01-15 00:00:00")),
            'occupation' => 'Test',
            'industry' => 'Test',
            'createTime' => new MongoDate(),
            'modifyTime' => new MongoDate(strtotime("2010-01-15 00:00:00")),
        );

        $job = new Application_Model_Job();
        $job->setJson($test);
        $job->save();
        $this->getResponse()->setBody('Resource created');
        $this->getResponse()->setHttpResponseCode(201);
    }

    public function putAction(){
        $jobId = (int) $this->_getParam('id');
        $job = Application_Model_Job::fetchOne(array('id' => $jobId));
        $job->jobTitle = 'Update';
        $job->location = 'Update';
        $job->contactEmail = 'update@mail.com';
        $job->occupation = 'Update';
        $job->industry = 'Update';
        $job->save();
        $this->getResponse()->setBody(sprintf('Resource #%s Updated', $jobId));
        $this->getResponse()->setHttpResponseCode(201);
    }

    public function deleteAction(){
        $jobId = (int) $this->_getParam('id');
        $job = Application_Model_Job::fetchOne(array('id' => $jobId));
        $job->delete();
        $this->getResponse()->setBody(sprintf('Job #%s Deleted', $jobId));
        $this->getResponse()->setHttpResponseCode(200);
    }
}