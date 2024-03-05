<?php

namespace App\States;

enum StudentStates: string
{
    case NotJoined = 'not_joined';

    case GroupLeader = 'group_leader';

    case GroupMember = 'group_member';

    public static function NotJoined(): self
    {
        return self::NotJoined;
    }

    public static function GroupLeader(): self
    {
        return self::GroupLeader;
    }

    public static function GroupMember(): self
    {
        return self::GroupMember;
    }
}
