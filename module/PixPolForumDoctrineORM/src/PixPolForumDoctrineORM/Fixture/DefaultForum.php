<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use PixPolForum\Entity\Board;
use PixPolForum\Entity\Category;

class DefaultForum implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->createResolverCategory($manager, 0);
        $this->createCommunityCategory($manager, 1);
    }

    private function createResolverCategory(ObjectManager $manager, $position)
    {
        $category = new Category();
        $category->setPosition($position);
        $category->setName('Resolver');
        $manager->persist($category);

        $board = new Board();
        $board->setCategory($category);
        $board->setPosition(0);
        $board->setName('General');
        $board->setDescription('General questions related to Resolver.');
        $manager->persist($board);
    }

    private function createCommunityCategory(ObjectManager $manager, $position)
    {
        $category = new Category();
        $category->setPosition($position);
        $category->setName('Community');
        $manager->persist($category);

        $board = new Board();
        $board->setCategory($category);
        $board->setPosition(0);
        $board->setName('General Discussion');
        $board->setDescription('Chat about basically anything');
        $manager->persist($board);

        $board = new Board();
        $board->setCategory($category);
        $board->setPosition(1);
        $board->setName('Website Feedback & Support');
        $board->setDescription('Get support for any website issues & share your feedback!');
        $manager->persist($board);

        $manager->flush();
    }
}
