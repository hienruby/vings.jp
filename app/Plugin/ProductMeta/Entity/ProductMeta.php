<?php

/*
 * This file is part of the ProductMeta
 *
 * Copyright (C) 2017 ONE HAND RED
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductMeta\Entity;

class ProductMeta extends \Eccube\Entity\AbstractEntity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $keyword;

    /**
     * @var string
     */
    private $meta_robots;
    
    /**
     * @var string
     */
    private $meta_tags;

    /**
     * Set id
     *
     * @param string $id
     * @return PageLayout
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return PageLayout
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PageLayout
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return PageLayout
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set meta_robots
     *
     * @param string $metaRobots
     * @return PageLayout
     */
    public function setMetaRobots($metaRobots)
    {
        $this->meta_robots = $metaRobots;

        return $this;
    }

    /**
     * Get meta_robots
     *
     * @return string
     */
    public function getMetaRobots()
    {
        return $this->meta_robots;
    }
    
    /**
     * Set meta_tags
     *
     * @param string $metaTags
     * @return PageLayout
     */
    public function setMetaTags($metaTags)
    {
        $this->meta_tags = $metaTags;

        return $this;
    }

    /**
     * Get meta_tags
     *
     * @return string
     */
    public function getMetaTags()
    {
        return $this->meta_tags;
    }
}