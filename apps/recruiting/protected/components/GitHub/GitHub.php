<?php

class GitHub extends BaseAppComponent
{
    /**
     * @var GitHubClient
     */
    public $api;

    public function init()
    {
        if (!$this->api) {
            $api = new GitHubClient();
            $api->setCredentials(
                Yii::app()->params['gitHub']['username'],
                Yii::app()->params['gitHub']['password']
            );

            $this->api = $api;
        }

        parent::init();
    }

    public function getInfo($user)
    {
        try {
            return $this->api->users->getSingleUser($user);
        } catch (Exception $e) {
        }
    }

    public function getRepositories($user)
    {
        return $this->api->repos->listUserRepositories($user);
    }

    public function search($params)
    {
//      q=location:kharkiv,ukraine+language:js
        $array = array();
        if ($params['location']) {
            $array[] = 'location:' . $params['location'];
        }
        if ($params['language']) {
            $array[] = 'language:' . $params['language'];
        }

        $page = 1;
        if ($params['page']) {
            $page = $params['page'];
        }


        $q = implode(' ', $array);
        $data = array(
            'q' => $q,
            'page' => $page,
        );

        return $this->api->users->searchUsers($data);
    }
} 