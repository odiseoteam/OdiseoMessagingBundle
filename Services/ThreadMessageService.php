<?php

namespace Odiseo\Bundle\MessagingBundle\Services;

use FOS\MessageBundle\EntityManager\ThreadManager;
use FOS\MessageBundle\Model\ParticipantInterface;

class ThreadMessageService extends ThreadManager
{
	public function searchThreadByCreatorAndTopic($creatorId, $topicId)
    {
		return $this->repository->findOneBy(array('createdBy' => $creatorId, 'topic' => $topicId));
	}
	
	public function findThreadsWhereIsParticipating(ParticipantInterface $participant)
    {
		return $this->repository
            ->createQueryBuilder('t')
		    ->innerJoin('t.metadata', 'tm')
		    ->innerJoin('tm.participant', 'p')
			->innerJoin('t.topic', 'tp')
		
		    // the participant is in the thread participants
		    ->andWhere('p.id = :participant_id')
		    ->setParameter('participant_id', $participant->getId())
		
		    // the thread does not contain spam or flood
		    ->andWhere('t.isSpam = :isSpam')
		    ->setParameter('isSpam', false, \PDO::PARAM_BOOL)
		
		    // the thread is not deleted by this participant
		    ->andWhere('tm.isDeleted = :isDeleted')
		    ->setParameter('isDeleted', false, \PDO::PARAM_BOOL)

			->andWhere('tp.deletedAt IS NULL')
		
		    // there is at least one message written by an other participant
		
		    // sort by date of last message written by an other participant
		    ->orderBy('tm.lastMessageDate', 'DESC')
		    ->getQuery()
		    ->execute()
        ;
	}


	public function findNewMessagesFrom($messageId, $currentUserId)
	{
		$message = $this->findMessageById($messageId);
		$qb = $this->em->createQueryBuilder();
		$qb->select('m')// string 'u' is converted to array internally
			->from('Odiseo\Bundle\MessagingBundle\Model\Message', 'm')
			->where($qb->expr()->eq('m.thread', '?1'))
			->andWhere($qb->expr()->neq('m.sender', '?2'))
			->andWhere($qb->expr()->gt('m.createdAt', '?3'))
			->setParameters(array(1 => $message->getThread(), 2 => $currentUserId, 3 => $message->getCreatedAt()));
		return $qb->getQuery()->getResult();
	}

	public function findMessageById($messageId)
	{
		$qb = $this->em->createQueryBuilder();
		$qb->select('m')
		->from('Odiseo\Bundle\MessagingBundle\Model\Message', 'm')
			->where($qb->expr()->eq('m.id', '?1'));
		$qb->setParameter(1, $messageId );

		return $qb->getQuery()->getSingleResult();
	}
}