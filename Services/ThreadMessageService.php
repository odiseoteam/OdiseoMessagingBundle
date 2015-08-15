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
		
		    // the participant is in the thread participants
		    ->andWhere('p.id = :participant_id')
		    ->setParameter('participant_id', $participant->getId())
		
		    // the thread does not contain spam or flood
		    ->andWhere('t.isSpam = :isSpam')
		    ->setParameter('isSpam', false, \PDO::PARAM_BOOL)
		
		    // the thread is not deleted by this participant
		    ->andWhere('tm.isDeleted = :isDeleted')
		    ->setParameter('isDeleted', false, \PDO::PARAM_BOOL)
		
		    // there is at least one message written by an other participant
		
		    // sort by date of last message written by an other participant
		    ->orderBy('tm.lastMessageDate', 'DESC')
		    ->getQuery()
		    ->execute()
        ;
	}
}