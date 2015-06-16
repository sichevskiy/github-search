<?php


class SearchForm extends CFormModel
{
    public $location;
    public $language;
    public $page;

    public function rules()
    {
        return array(
            array('location, language, page', 'safe'),
        );
    }
} 