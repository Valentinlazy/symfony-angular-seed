<?php

namespace CoreDomain\Model;

class File
{
    protected $path;
    protected $originalName;

    public function __construct($path = null, $originalName = null)
    {
        $this->path = $path;
        $this->originalName = $originalName;
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return null
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }
}
