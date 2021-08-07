<?php

namespace Views;

use ReflectionClass;
use Throwable;

abstract class View
{
    public function __construct(array $props)
    {
        $ref = new ReflectionClass($this);

        foreach ($props as $prop => $desc) {
            if ($ref->hasProperty($prop)) {
                $this->{$prop} = $desc;
            }
        }
    }

    public function render()
    {
        return $this->renderTemplate($this->template);
    }

    public function renderTemplate($template, $params = [])
    {
        try {
            extract($params);
            ob_start();
            require __DIR__ . '/templates/' . $template . '.tpl';
            return ob_get_clean();
        } catch (Throwable $ex) {
            ob_get_clean();
            var_dump($ex->getMessage());
        }
    }
}