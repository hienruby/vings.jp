<?php
/*
 * Copyright(c) 2016 U-Mebius
 */

namespace Plugin\CategoryCheckbox\Service;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Response;
use Eccube\Event\TemplateEvent;

class TwigService {

    /**
     * @var Application
     */
    public $app;

    /**
     * @var string
     */
    private $source;

    /**
     * @var array
     */
    private $lines;


    public function __construct(\Eccube\Application $app)
    {
        $this->app = $app;
    }

    public function initWithTemplateEvent(TemplateEvent $event)
    {
        $this->initWithTwig($event->getSource());
    }

    public function initWithTwig($source)
    {

        $this->source = $source;
        $this->lines = explode(PHP_EOL, $this->convEOL($this->source));
    }

    public function replace($search, $replace)
    {
        $replace = $this->convEOL($replace);
        $source = str_replace($search, $replace, $this->source);
        $this->source = $source;
        $this->lines = explode(PHP_EOL, $this->convEOL($this->source));
    }

    public function preg_replace($search, $replace)
    {
        $replace = $this->convEOL($replace);
        $source = preg_replace($search, $replace, $this->source);
        $this->source = $source;
        $this->lines = explode(PHP_EOL, $this->convEOL($this->source));
    }

    public function insert($search, $insert, $offset = 1)
    {
        $searchIndex = 0;

        $index = $this->getLineNumber($search, $searchIndex);

        $insertIndex = $index + $offset;

        $max = count($this->lines);
        for($i = $max; $i > $insertIndex; $i--) {
            $this->lines[$i] = $this->lines[$i-1];
        }

        $this->lines[$insertIndex] = $insert;
        $this->source = implode(PHP_EOL, $this->lines);
        $this->lines = explode(PHP_EOL, $this->convEOL($this->source));
    }

    private function getTwigFile($path)
    {
        $twigFile = $this->app['twig']->getLoader()->getSource($path);
        return $twigFile;
    }

    public function getSource()
    {
        return $this->source;
    }

    private function getLine($search, $searchIndex = 0)
    {

        $index = $this->getLineNumber($search, $searchIndex);

        if($index < 0) {
            return "";
        }

        return $this->lines[$index];
    }

    private function getLineNumber($search, $searchIndex = 0)
    {
        $cnt = 0;
        foreach ($this->lines as $key=> $val) {
            if(strpos($val, $search) !== false) {
                if($cnt == $searchIndex) {
                    return $key;
                }
                $cnt++;
            }
        }
        return -1;
    }

    private function convEOL($string, $to = PHP_EOL)
    {
        return preg_replace("/\r\n|\r|\n/", $to, $string);
    }


    public function prependToBlock($block, $insert){
        $insert = $this->convEOL($insert);
        if(preg_match('@(\{\%\s*block\s+'.$block.'\s*\%\})@', $this->source, $hits)){
            $source = str_replace($hits[1], $hits[1]."\n".$insert, $this->source);
            $this->source = $source;
            $this->lines = explode(PHP_EOL, $this->convEOL($this->source));
        }else{

            $this->source .= "\n{% block ".$block." %}\n".$insert."\n{% endblock %}";
            $this->lines = explode(PHP_EOL, $this->convEOL($this->source));
        }
    }
}