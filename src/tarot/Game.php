<?php



/**
 * Skeleton subclass for representing a row from the 'game' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tarot
 */
class Game extends BaseGame
{


      public function getScoreAfterBids() {
        $new_score = 0;
        $bids = $this->getBids();
        $score = $this->getScore();
        switch ($bids) {
        case 'prise':
            if($score < 0){
                $new_score = ($score - 25)*1;
            }elseif($score >=0){
                $new_score = ($score + 25)*1;
            }
            break;
        case 'garde':
            if($score < 0){
                $new_score = ($score - 25)*2;
            }elseif($score >=0){
                $new_score = ($score + 25)*2;
            }
            break;
        case 'garde_sans':
            if($score < 0){
                $new_score = ($score - 25)*4;
            }elseif($score >=0){
                $new_score = ($score + 25)*4;
            }
            break;
        case 'garde_contre':
            if($score < 0){
                $new_score = ($score - 25)*8;
            }elseif($score >=0){
                $new_score = ($score + 25)*8;
            }
            break;
        }
        return $new_score;
      }
}
