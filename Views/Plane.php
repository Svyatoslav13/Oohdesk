<?php

namespace Views;

class Plane extends View
{
    public $template;
    public $test;

    public function get_planes()
    {
        return [
            [
                'id' => 1,
                'name' => 'boieng 10',
                'status' => 'В ангаре'
            ],
            [
                'id' => 2,
                'name' => 'boieng 101',
                'status' => 'В ангаре'
            ],
            [
                'id' => 32,
                'name' => 'boieng 1',
                'status' => 'В ангаре'
            ],
            [
                'id' => 42,
                'name' => 'boieng 1005',
                'status' => 'В ангаре'
            ]
        ];
    }
}