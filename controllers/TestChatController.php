<?php

namespace app\controllers;

use yii\base\Controller;
use Pusher\Pusher;

class TestChatController extends Controller
{
    /**
     * Renders chat page
     * 
     * @return string
     */
    public function actionChat()
    {
        $options = [
            'cluster' => 'eu',
            'encrypted' => true
        ];
         
        $pusher = new Pusher(
            'ea2916c64230438cf47f',
            '46fe5b224d108dbdca73',
            '1443896',
            $options
          );
        // Check the receive message
         
        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $data = $_POST['message'];
            
            // Return the received message
            if($pusher->trigger('giga.chat-service', 'send', $data)) {
                echo 'success';
            } else {
                echo 'error';
            }
        
        }
        
        return $this->renderPartial('test-chat');
    }
}