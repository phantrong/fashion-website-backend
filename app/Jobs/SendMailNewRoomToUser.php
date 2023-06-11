<?php

namespace App\Jobs;

use App\Enum\LogEnum;
use App\Enum\UserEnum;
use App\Mail\MailNewRoomToUser;
use App\Services\Business;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailNewRoomToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $room;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $room)
    {
        $this->room = $room;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = Business::getUser()->getAllList([
            'notifications_email' => UserEnum::NOTIFICATION_BY_EMAIL,
            'status' => UserEnum::STATUS_ACTIVE,
        ], [
            'id',
            'email',
        ]);

        $userMails = [];
        if ($users && count($users) > 0) {
            foreach ($users as $user) {
                $keyWords = Business::getHistorySearchKeyWord()->getListByUserId($user->id);
                $infoSuggestion = Business::getInterestedRoomInfomation()->getListByUserId($user->id);
                $conditions['user_id'] = $user->id;
                $conditions['customer_id'] = null;
                $arrayIds = Business::getRoom()->getSuggestionRoomArrayIds($keyWords, $infoSuggestion, $conditions);
                if (in_array(@$this->room->id, $arrayIds)) {
                    $userMails[] = $user->email;
                }
            }
        }
        if (!empty($userMails)) {
            log_send_email(implode(',', $userMails), LogEnum::LOG_EMAIL_NEW_ROOM, $this->room);
            Mail::to($userMails)->send(new MailNewRoomToUser($this->room));
        }
    }
}
