<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

use PixPolForum\Entity\Board;
use PixPolForum\Entity\Category;
use PixPolForum\Entity\Post;
use PixPolForum\Entity\Topic;

// Change the current working direction:
chdir(__DIR__ . '/../');

// Setup autoloading:
include 'vendor/autoload.php';
$GLOBALS['extension'] = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : 'local';

// Run the application!
$application = Zend\Mvc\Application::init(include 'config/application.config.php');
$serviceManager = $application->getServiceManager();

// Get all services:
$em = $serviceManager->get('Doctrine\ORM\EntityManager');
$permissionService = $serviceManager->get('PixPolPermissionService');
$roleService = $serviceManager->get('PixPolRoleService');
$userService = $serviceManager->get('PixPolUserService');
$tagService = $serviceManager->get('PixPolTag\Service\TagService');

// Create the employee tag
$employeeTag = new \PixPolTag\Entity\Tag();
$employeeTag->setTag('employee');
$tagService->persist($employeeTag);

// Create the Owner role:
$ownerRole = new \PixPolUser\Entity\Role();
$ownerRole->setName('Owner');
$ownerRole->setDescription('The owners of Pixel Polishers.');
foreach ($permissionService->findAll() as $permission) {
    $ownerRole->addPermission($permission->getName());
}
$roleService->persist($ownerRole);

$defaultUser = new \PixPolUser\Entity\User();
$defaultUser->setName('Walter');
$defaultUser->setSurname('Tamboer');
$defaultUser->setPassword($userService->getPassword()->create('test'));
$defaultUser->setEmail('w.tamboer@pixelpolishers.com');
$defaultUser->setRegistrationDate(new \DateTime());
$defaultUser->addRole($ownerRole);
$defaultUser->addTag($employeeTag);
$userService->persist($defaultUser);

// Create a lot of users:
$alphabet = range('A', 'Z');
for ($i = 1; $i <= 100; ++$i) {
    $defaultUser = new \PixPolUser\Entity\User();
    $defaultUser->setName('User ' . $i);
    $defaultUser->setSurname($alphabet[rand(0, count($alphabet) - 1)]);
    $defaultUser->setPassword($userService->getPassword()->create('test'));
    $defaultUser->setEmail('user' . $i . '@pixelpolishers.com');
    $defaultUser->setRegistrationDate(new \DateTime());
    $em->persist($defaultUser);
}
$em->flush();

// Create the forum:
createResolverCategory($em, 0);
createCommunityCategory($em, 1);
$em->flush();

function createResolverCategory(ObjectManager $manager, $position)
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
    $board->setTopicCount(3);
    $manager->persist($board);

    createResolverTopics($manager, $board);
    $manager->persist($board);
}

function createResolverTopics(ObjectManager $manager, Board $board)
{
    $postsToCreated = 25;

    for ($topicIndex = 1; $topicIndex <= $board->getTopicCount(); ++$topicIndex) {
        $createdOn = getRandomDate();

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
        $topic->setCreatedBy($defaultUser);
        $topic->setPostCount($postsToCreated);
        $manager->persist($topic);

        for ($postIndex = 1; $postIndex <= $postsToCreated; ++$postIndex) {
            $post = new Post();
            $post->setTopic($topic);

            if ($postIndex == 1) {
                $post->setContent('This is topic ' . $topicIndex . ' and post number ' . $postIndex);
            } else {
                $post->setContent(getContent());
            }

            $post->setCreatedOn($createdOn);
            $post->setCreatedBy(getUser($manager, 1));

            $manager->persist($post);
            $topic->setLastPost($post);

            $createdOn = getRandomDate($createdOn);
        }

        $manager->persist($topic);
        $board->setLastTopic($topic);
    }
}

function createCommunityCategory(ObjectManager $manager, $position)
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
    $board->setTopicCount(0);
    $manager->persist($board);

    $board = new Board();
    $board->setCategory($category);
    $board->setPosition(1);
    $board->setName('Website Feedback & Support');
    $board->setDescription('Get support for any website issues & share your feedback!');
    $board->setTopicCount(0);
    $manager->persist($board);
}

function getContent()
{
    $content = array();
    $content[] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et iaculis justo, at aliquet ipsum. Ut sed dolor ac risus porttitor vehicula quis vitae enim. Mauris vel fermentum ligula. Nam in faucibus sem. Donec id tristique odio. Nam molestie ac metus quis hendrerit. Integer id justo ut dui mollis ornare nec in magna. Integer in luctus lectus. Nullam in ligula id odio hendrerit pretium vestibulum vel massa. Maecenas lobortis dolor vel massa venenatis, ut commodo dolor aliquam. Vestibulum suscipit, sem eget hendrerit bibendum, nisi nisi placerat urna, eget molestie eros leo eget orci. In tincidunt sodales mauris, a pellentesque lacus luctus imperdiet. Aenean id augue scelerisque, fermentum orci nec, tempor sem. Vestibulum varius pulvinar lectus, vitae laoreet ipsum sagittis laoreet. Nullam a orci libero.';
    $content[] = 'Vivamus non tristique massa. Vestibulum quis adipiscing leo. Phasellus ut nibh id odio malesuada ultricies a eget lectus. Praesent quis hendrerit leo. Donec rhoncus id nisi sed suscipit. Suspendisse faucibus rutrum nibh, vitae porta odio aliquet vehicula. Quisque vitae viverra elit, non fermentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris sit amet vulputate leo. Nam id luctus sapien, quis luctus est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas et risus nec dui feugiat rutrum ut in lacus. Fusce tristique ullamcorper iaculis. Aliquam lobortis leo id leo fermentum faucibus. Vestibulum congue diam a nunc pretium venenatis.';
    $content[] = 'Ut mi libero, viverra eget semper sit amet, luctus sed sapien. Nullam semper enim at imperdiet interdum. Curabitur varius est vitae lorem pharetra, nec vestibulum mauris posuere. Aenean rutrum luctus augue, ut viverra eros luctus nec. Vestibulum quis porta libero. Curabitur et ante mi. Nulla a massa leo. Phasellus sed malesuada diam.';
    $content[] = 'Etiam lobortis, nibh sit amet euismod lacinia, ligula dolor egestas nibh, eget ultrices justo odio vitae ligula. Nam congue felis eu augue sollicitudin, at faucibus neque lacinia. Vestibulum quis placerat metus, sed dignissim neque. Praesent ac lobortis sapien. Suspendisse at scelerisque nisl, sit amet aliquam urna. Quisque commodo ipsum vitae enim tristique, laoreet molestie purus condimentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut tempus non augue in viverra. Ut id turpis tempus, rutrum massa nec, iaculis nibh. Proin vitae nisi consequat, hendrerit enim et, pellentesque lorem. Etiam auctor ipsum a vestibulum commodo. Quisque aliquet mollis mi et posuere. Donec fermentum arcu sit amet enim bibendum rutrum. Donec massa tellus, pretium ac ullamcorper et, rhoncus id diam. Donec dignissim lacus vel est lacinia consequat.';
    return implode(PHP_EOL . PHP_EOL, $content);
}

function getUser(ObjectManager $manager, $id)
{
    return $manager->find('PixPolUser\Entity\User', $id);
}

function getRandomDate(DateTime $oldDate = null)
{
    if ($oldDate === null) {
        $oldDate = new DateTime();
        $oldDate->modify('-2 years');
    }

    $dateTime = clone $oldDate;

    $amount = rand(1, 100);
    switch (rand(0, 2)) {
        case 0:
            $dateTime->modify('+ ' . $amount . ' minutes');
            break;

        case 1:
            $dateTime->modify('+ ' . $amount . ' hours');
            break;

        case 2:
            $dateTime->modify('+ ' . $amount . ' days');
            break;
    }

    return $dateTime;
}