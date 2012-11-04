<?php
/**
 * Phergie (http://phergie.org)
 *
 * @link http://github.com/phergie/phergie-irc-generator for the canonical source repository
 * @copyright Copyright (c) 2008-2012 Phergie Development Team (http://phergie.org)
 * @license http://phergie.org/license New BSD License
 * @package Phergie\Irc
 */

namespace Phergie\Irc;

/**
 * Programmatically generates strings containing messages conforming to those
 * in the IRC protocol as described in RFC 1459.
 *
 * @category Phergie
 * @package Phergie\Irc
 * @link http://irchelp.org/irchelp/rfc/chapter2.html#c2_3
 * @link http://irchelp.org/irchelp/rfc/chapter4.html
 * @link http://irchelp.org/irchelp/rfc/chapter5.html
 */
interface GeneratorInterface
{
    /**
     * Sets the message prefix.
     *
     * @param string $prefix
     * @link http://irchelp.org/irchelp/rfc/chapter2.html#c2_3_1
     */
    public function setPrefix($prefix);

    /**
     * Returns a PASS message.
     *
     * @parm string $password
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_1
     */
    public function ircPass($password);

    /**
     * Returns a NICK message.
     *
     * @param string $nickname
     * @param int $hopcount
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_2
     */
    public function ircNick($nickname, $hopcount = null);

    /**
     * Returns a USER message.
     *
     * @param string $username
     * @param string $hostname
     * @param string $servername
     * @param string $realname
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_3
     */
    public function ircUser($username, $hostname, $servername, $realname);

    /**
     * Returns a SERVER message.
     *
     * @param string $servername
     * @param int $hopcount
     * @param string $info
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_4
     */
    public function ircServer($servername, $hopcount, $info);

    /**
     * Returns an OPER message.
     *
     * @param string $user
     * @param string $password
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_5
     */
    public function ircOper($user, $password);

    /**
     * Returns a QUIT message.
     *
     * @param string $message
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_6
     */
    public function ircQuit($message = null);

    /**
     * Returns an SQUIT message.
     *
     * @param string $server
     * @param string $comment
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_1_7
     */
    public function ircSquit($server, $comment);

    /**
     * Returns a JOIN message.
     *
     * @param string $channels
     * @param string $keys
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_1
     */
    public function ircJoin($channels, $keys = null);

    /**
     * Returns a PART message.
     *
     * @param string $channels
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_2
     */
    public function ircPart($channels);

    /**
     * Returns a MODE message.
     *
     * @param string $target
     * @param string $mode
     * @param string $param
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_3
     */
    public function ircMode($target, $mode, $param = null);

    /**
     * Returns a TOPIC message.
     *
     * @param string $channel
     * @param string $topic
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_4
     */
    public function ircTopic($channel, $topic = null);

    /**
     * Returns a NAMES message.
     *
     * @param string $channels
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_5
     */
    public function ircNames($channels);

    /**
     * Returns a LIST message.
     *
     * @param string $channels
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_6
     */
    public function ircList($channels = null, $server = null);

    /**
     * Returns an INVITE message.
     *
     * @param string $nickname
     * @param string $channel
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_7
     */
    public function ircInvite($nickname, $channel);

    /**
     * Returns a KICK message.
     *
     * @param string $channel
     * @param string $user
     * @param string $comment
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_2_8
     */
    public function ircKick($channel, $user, $comment = null);

    /**
     * Returns a VERSION message.
     *
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_1
     */
    public function ircVersion($server = null);

    /**
     * Returns a STATS message.
     *
     * @param string $query
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_2
     */
    public function ircStats($query, $server = null);

    /**
     * Returns a LINKS message.
     *
     * Note that the parameter order of this method is reversed with respect to
     * the corresponding IRC message to alleviate the need to explicitly specify
     * a null value for $remoteserver when it is not used.
     *
     * @param string $servermask
     * @param string $remoteserver
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_3
     */
    public function ircLinks($servermask = null, $remoteserver = null);

    /**
     * Returns a TIME message.
     *
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_4
     */
    public function ircTime($server = null);

    /**
     * Returns a CONNECT message.
     *
     * @param string $targetserver
     * @param int $port
     * @param string $remoteserver
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_5
     */
    public function ircConnect($targetserver, $port = null, $remoteserver = null);

    /**
     * Returns a TRACE message.
     *
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_6
     */
    public function ircTrace($server = null);

    /**
     * Returns an ADMIN message.
     *
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_7
     */
    public function ircAdmin($server = null);

    /**
     * Returns an INFO message.
     *
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_3_8
     */
    public function ircInfo($server = null);

    /**
     * Returns a PRIVMSG message.
     *
     * @param string $receivers
     * @param string $text
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_4_1
     */
    public function ircPrivmsg($receivers, $text);

    /**
     * Returns a NOTICE message.
     *
     * @param string $nickname
     * @param string $text
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_4_2
     */
    public function ircNotice($nickname, $text);

    /**
     * Returns a WHO message.
     *
     * @param string $name
     * @param string $o
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_5_1
     */
    public function ircWho($name, $o = null);

    /**
     * Returns a WHOIS message.
     *
     * @param string $server
     * @param string $nickmasks
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_5_2
     */
    public function ircWhois($server, $nickmasks);

    /**
     * Returns a WHOWAS message.
     *
     * @param string $nickname
     * @param int $count
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_5_3
     */
    public function ircWhowas($nickname, $count = null, $server = null);

    /**
     * Returns a KILL message.
     *
     * @param string $nickname
     * @param string $comment
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_6_1
     */
    public function ircKill($nickname, $comment);

    /**
     * Returns a PING message.
     *
     * @param string $server1
     * @param string $server2
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_6_2
     */
    public function ircPing($server1, $server2 = null);

    /**
     * Returns a PONG message.
     *
     * @param string $daemon
     * @param string $daemon2
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_6_3
     */
    public function ircPong($daemon, $daemon2 = null);

    /**
     * Returns an ERROR message.
     *
     * @param string $message
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter4.html#c4_6_4
     */
    public function ircError($message);

    /**
     * Returns an AWAY message.
     *
     * @param string $message
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_1
     */
    public function ircAway($message = null);

    /**
     * Returns a REHASH message.
     *
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_2
     */
    public function ircRehash();

    /**
     * Returns a RESTART message.
     *
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_3
     */
    public function ircRestart();

    /**
     * Returns a SUMMON message.
     *
     * @param string $user
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_4
     */
    public function ircSummon($user, $server = null);

    /**
     * Returns a USERS message.
     *
     * @param string $server
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_5
     */
    public function ircUsers($server = null);

    /**
     * Returns a WALLOPS message.
     *
     * @param string $text
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_6
     */
    public function ircWallops($text);

    /**
     * Returns a USERHOST message.
     *
     * @param string $nickname1
     * @param string $nickname2
     * @param string $nickname3
     * @param string $nickname4
     * @param string $nickname5
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_7
     */
    public function ircUserhost($nickname1, $nickname2 = null, $nickname3 = null, $nickname4 = null, $nickname5 = null);

    /**
     * Returns an ISON message.
     *
     * @param string $nicknames
     * @return string
     * @link http://irchelp.org/irchelp/rfc/chapter5.html#c5_8
     */
    public function ircIson($nicknames);

    /**
     * Returns a CTCP FINGER message.
     *
     * @param string $receivers
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpFinger($receivers);

    /**
     * Returns a CTCP FINGER reply message.
     *
     * @param string $nickname
     * @param string $text
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpFingerResponse($nickname, $text);

    /**
     * Returns a CTCP VERSION message.
     *
     * @param string $receivers
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpVersion($receivers);

    /**
     * Returns a CTCP VERSION reply message.
     *
     * @param string $nickname
     * @param string $name
     * @param string $version
     * @param string $environment
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpVersionResponse($nickname, $name, $version, $environment);

    /**
     * Returns a CTCP SOURCE message.
     *
     * @param string $receivers
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpSource($receivers);

    /**
     * Returns a CTCP SOURCE reply message.
     *
     * @param string $nickname
     * @param string $host
     * @param string $directories
     * @param string $files
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpSourceResponse($nickname, $host, $directories, $files);

    /**
     * Returns a CTCP USERINFO message.
     *
     * @param string $receivers
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpUserinfo($receivers);

    /**
     * Returns a CTCP USERINFO reply message.
     *
     * @param string $nickname
     * @param string $text
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpUserinfoResponse($nickname, $text);

    /**
     * Returns a CTCP CLIENTINFO message.
     *
     * @param string $receivers
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpClientinfo($receivers);

    /**
     * Returns a CTCP CLIENTINFO reply message.
     *
     * @param string $nickname
     * @param string $client
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpClientinfoResponse($nickname, $client);

    /**
     * Returns a CTCP ERRMSG message.
     *
     * @param string $receivers
     * @param string $query
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpErrmsg($receivers, $query);

    /**
     * Returns a CTCP ERRMSG reply message.
     *
     * @param string $nickname
     * @param string $query
     * @param string $message
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpErrmsgResponse($nickname, $query, $message);

    /**
     * Returns a CTCP PING message.
     *
     * @param string $receivers
     * @param int $timestamp
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpPing($receivers, $timestamp);

    /**
     * Returns a CTCP PING reply message.
     *
     * @param string $nickname
     * @param int $timestamp
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpPingResponse($nickname, $timestamp);

    /**
     * Returns a CTCP TIME message.
     *
     * @param string $receivers
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpTime($receivers);

    /**
     * Returns a CTCP TIME reply message.
     *
     * @param string $nickname
     * @param string $time
     * @return string
     * @link http://irchelp.org/irchelp/rfc/ctcpspec.html
     */
    public function ctcpTimeResponse($nickname, $time);
}
