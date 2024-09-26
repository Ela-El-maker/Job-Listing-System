<?php
namespace App\Services;

class Notify
{
    //Created Notification
    static function createdNotification()
    {
        return notyf()->addSuccess('Created Successfully');
    }
    // Updated Notification
    static function updatedNotification()
    {
        return notyf()->addSuccess('Updated Successfully');
    }
    // Deleted Notification
    static function deletedNotification()
    {
        return notyf()->addSuccess('Deleted Successfully');
    }
}
