<?php
class Application_Model_Job extends Shanty_Mongo_Document{
    protected static $_db = 'softserve';
    protected static $_collection = 'jobs';
    protected static $_requirements = array(
        'id' => 'Required',
        'jobTitle' => 'Required',
        'jobSalary' => 'Required',
        'location' => 'Required',
        'contactEmail' => 'Required',
        'endTime' => 'Required',
        'occupation' => 'Required',
        'industry' => 'Required',
        'createTime' => 'Required',
        'modifyTime' => 'Required'
    );

    public function getJson(){
        $job["id"] = $this->id;
        $job["jobTitle"] = $this->jobTitle;
        $job["jobSalary"] = $this->jobSalary;
        $job["location"] = $this->location;
        $job["contactEmail"] = $this->contactEmail;
        $job["endTime"] = date('Y-M-d h:i:s', $this->endTime->sec);
        $job["occupation"] = $this->occupation;
        $job["industry"] = $this->industry;
        $job["createTime"] = date('Y-M-d h:i:s', $this->createTime->sec);
        $job["modifyTime"] = date('Y-M-d h:i:s', $this->modifyTime->sec);
        return $job;
    }
    public function setJson($job){
        $this->id = $job["id"];
        $this->jobTitle = $job["jobTitle"];
        $this->jobSalary = $job["jobSalary"];
        $this->location = $job["location"];
        $this->contactEmail = $job["contactEmail"];
        $this->endTime = $job["endTime"];
        $this->occupation = $job["occupation"];
        $this->industry = $job["industry"];
        $this->createTime = $job["createTime"];
        $this->modifyTime = $job["modifyTime"];
    }
}