<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Fixture;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PixPolForum\Entity\Board;
use PixPolForum\Entity\Category;
use PixPolForum\Entity\Post;
use PixPolForum\Entity\Topic;

class DefaultForum extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 600;
    }

    public function load(ObjectManager $manager)
    {
        $this->createResolverCategory($manager, 0);
        $this->createCommunityCategory($manager, 1);

        $manager->flush();
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

        $this->createResolverTopics($manager, $board);
    }

    private function createResolverTopics(ObjectManager $manager, Board $board)
    {
        for ($topicIndex = 1; $topicIndex <= 100; ++$topicIndex) {
            $createdOn = $this->getRandomDate();

            $isLocked = rand() % 3 == 0;
            $isSticky = rand() % 2 == 0;

            $title = 'Topic ' . $topicIndex;
            if ($isLocked && $isSticky) {
                $title .= ' (locked & sticky)';
            } else if ($isLocked) {
                $title .= ' (locked)';
            } else {
                $title .= ' (sticky)';
            }

            $topic = new Topic();
            $topic->setBoard($board);
            $topic->setLocked($isLocked);
            $topic->setSticky($isSticky);
            $topic->setTitle($title);
            $topic->setCreatedOn($createdOn);
            $topic->setCreatedBy($this->getUser($manager, 1));
            $manager->persist($topic);

            for ($postIndex = 1; $postIndex <= 25; ++$postIndex) {
                $post = new Post();
                $post->setTopic($topic);

                if ($postIndex == 1) {
                    $post->setContent('This is topic ' . $topicIndex . ' and post number ' . $postIndex);
                } else {
                    $post->setContent($this->getContent());
                }

                $post->setCreatedOn($createdOn);
                $post->setCreatedBy($this->getUser($manager, 1));
                $manager->persist($post);

                $createdOn = $this->getRandomDate($createdOn);
            }
        }
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
    }

    private function getContent()
    {
        $content = array();
        $content[] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et iaculis justo, at aliquet ipsum. Ut sed dolor ac risus porttitor vehicula quis vitae enim. Mauris vel fermentum ligula. Nam in faucibus sem. Donec id tristique odio. Nam molestie ac metus quis hendrerit. Integer id justo ut dui mollis ornare nec in magna. Integer in luctus lectus. Nullam in ligula id odio hendrerit pretium vestibulum vel massa. Maecenas lobortis dolor vel massa venenatis, ut commodo dolor aliquam. Vestibulum suscipit, sem eget hendrerit bibendum, nisi nisi placerat urna, eget molestie eros leo eget orci. In tincidunt sodales mauris, a pellentesque lacus luctus imperdiet. Aenean id augue scelerisque, fermentum orci nec, tempor sem. Vestibulum varius pulvinar lectus, vitae laoreet ipsum sagittis laoreet. Nullam a orci libero.';
        $content[] = 'Vivamus non tristique massa. Vestibulum quis adipiscing leo. Phasellus ut nibh id odio malesuada ultricies a eget lectus. Praesent quis hendrerit leo. Donec rhoncus id nisi sed suscipit. Suspendisse faucibus rutrum nibh, vitae porta odio aliquet vehicula. Quisque vitae viverra elit, non fermentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris sit amet vulputate leo. Nam id luctus sapien, quis luctus est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas et risus nec dui feugiat rutrum ut in lacus. Fusce tristique ullamcorper iaculis. Aliquam lobortis leo id leo fermentum faucibus. Vestibulum congue diam a nunc pretium venenatis.';
        $content[] = 'Ut mi libero, viverra eget semper sit amet, luctus sed sapien. Nullam semper enim at imperdiet interdum. Curabitur varius est vitae lorem pharetra, nec vestibulum mauris posuere. Aenean rutrum luctus augue, ut viverra eros luctus nec. Vestibulum quis porta libero. Curabitur et ante mi. Nulla a massa leo. Phasellus sed malesuada diam.';
        $content[] = 'Etiam lobortis, nibh sit amet euismod lacinia, ligula dolor egestas nibh, eget ultrices justo odio vitae ligula. Nam congue felis eu augue sollicitudin, at faucibus neque lacinia. Vestibulum quis placerat metus, sed dignissim neque. Praesent ac lobortis sapien. Suspendisse at scelerisque nisl, sit amet aliquam urna. Quisque commodo ipsum vitae enim tristique, laoreet molestie purus condimentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut tempus non augue in viverra. Ut id turpis tempus, rutrum massa nec, iaculis nibh. Proin vitae nisi consequat, hendrerit enim et, pellentesque lorem. Etiam auctor ipsum a vestibulum commodo. Quisque aliquet mollis mi et posuere. Donec fermentum arcu sit amet enim bibendum rutrum. Donec massa tellus, pretium ac ullamcorper et, rhoncus id diam. Donec dignissim lacus vel est lacinia consequat.';
        return implode(PHP_EOL . PHP_EOL, $content);
    }

    private function getUser(ObjectManager $manager, $id)
    {
        return $manager->find('PixPolUser\Entity\User', $id);
    }

    private function getRandomDate(DateTime $smallerThen = null)
    {
        if ($smallerThen === null) {
            $smallerThen = new DateTime();
            $smallerThen->modify('+ 1 year');
        }

        $dateTime = clone $smallerThen;

        $amount = rand(1, 100);
        switch (rand(0, 2)) {
            case 0:
                $dateTime->modify('- ' . $amount . ' minutes');
                break;

            case 1:
                $dateTime->modify('- ' . $amount . ' hours');
                break;

            case 2:
                $dateTime->modify('- ' . $amount . ' days');
                break;
        }

        return $dateTime;
    }
}
