<?php
/**
 * ownCloud - polls
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Vinzenz Rosenkranz <vinzenz.rosenkranz@gmail.com>
 * @copyright Vinzenz Rosenkranz 2016
 */

namespace OCA\Polls\AppInfo;


use OC\AppFramework\Utility\SimpleContainer;
use \OCP\AppFramework\App;
use \OCA\Polls\Db\AccessMapper;
use \OCA\Polls\Db\CommentMapper;
use \OCA\Polls\Db\DateMapper;
use \OCA\Polls\Db\EventMapper;
use \OCA\Polls\Db\NotificationMapper;
use \OCA\Polls\Db\ParticipationMapper;
use \OCA\Polls\Db\ParticipationTextMapper;
use \OCA\Polls\Db\TextMapper;
use \OCA\Polls\Controller\PageController;


class Application extends App {


	public function __construct (array $urlParams=array()) {
		parent::__construct('polls', $urlParams);

		$container = $this->getContainer();
		$server = $container->getServer();

		/**
		 * Controllers
		 */
		$container->registerService('PageController', function($c) use($server) {
			/** @var SimpleContainer $c */
			return new PageController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('UserManager'),
				$c->query('GroupManager'),
				$c->query('AvatarManager'),
				$c->query('Logger'),
				$c->query('L10N'),
				$c->query('ServerContainer')->getURLGenerator(),
				$c->query('UserId'),
				$c->query('AccessMapper'),
				$c->query('CommentMapper'),
				$c->query('DateMapper'),
				$c->query('EventMapper'),
				$c->query('NotificationMapper'),
				$c->query('ParticipationMapper'),
				$c->query('ParticipationTextMapper'),
				$c->query('TextMapper')
			);
		});

		$container->registerService('UserManager', function($c) {
			return $c->query('ServerContainer')->getUserManager();
		});

        $container->registerService('GroupManager', function($c) {
            return $c->query('ServerContainer')->getGroupManager();
        });

		$container->registerService('AvatarManager', function($c) {
			return $c->query('ServerContainer')->getAvatarManager();
		});

        $container->registerService('Logger', function($c) {
            return $c->query('ServerContainer')->getLogger();
        });

        $container->registerService('L10N', function($c) {
            return $c->query('ServerContainer')->getL10N($c->query('AppName'));
        });

		$container->registerService('AccessMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new AccessMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('CommentMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new CommentMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('DateMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new DateMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('EventMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new EventMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('NotificationMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new NotificationMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('ParticipationMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new ParticipationMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('ParticipationTextMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new ParticipationTextMapper(
				$server->getDatabaseConnection()
			);
		});
		$container->registerService('TextMapper', function($c) use ($server) {
			/** @var SimpleContainer $c */
			return new TextMapper(
				$server->getDatabaseConnection()
			);
		});

	}


}
