<?php
/**
 * Phergie (http://phergie.org)
 *
 * @link http://github.com/phergie/phergie-irc-generator for the canonical source repository
 * @copyright Copyright (c) 2008-2014 Phergie Development Team (http://phergie.org)
 * @license http://phergie.org/license Simplified BSD License
 * @package Phergie\Irc
 */

namespace Phergie\Irc;

/**
 * Canonical implementation of GeneratorInterface.
 *
 * @category Phergie
 * @package Phergie\Irc
 */
class Generator implements GeneratorInterface
{
    /**
     * Message prefix
     *
     * @var string
     */
    protected $prefix = null;

    /**
     * Implements GeneratorInterface::setPrefix().
     *
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Returns a formatted IRC message.
     *
     * @param string $type Command or response code
     * @param array $params Optional message parameters
     * @return string
     */
    protected function getIrcMessage($type, array $params = array())
    {
        $message = '';
        if ($this->prefix) {
            $message .= ':' . $this->prefix . ' ';
        }
        $message .= $type;

        $params = array_filter($params, function($param) {
            return $param !== null;
        });
        if ($params) {
            $last = end($params);
            $params[key($params)] = ':' . $last; 
            $message .= ' ' . implode(' ', $params);
        }
        
        $message .= "\r\n";
        return $message;
    }

    /**
     * Returns a PASS message.
     *
     * @param string $password
     * @return string
     */
    public function ircPass($password)
    {
        return $this->getIrcMessage('PASS', array($password));
    }

    /**
     * Returns a NICK message.
     *
     * @param string $nickname
     * @param int $hopcount
     * @return string
     */
    public function ircNick($nickname, $hopcount = null)
    {
        return $this->getIrcMessage('NICK', array($nickname, $hopcount));
    }

    /**
     * Returns a USER message.
     *
     * @param string $username
     * @param string $hostname
     * @param string $servername
     * @param string $realname
     * @return string
     */
    public function ircUser($username, $hostname, $servername, $realname)
    {
        return $this->getIrcMessage('USER', array($username, $hostname, $servername, $realname));
    }

    /**
     * Returns a SERVER message.
     *
     * @param string $servername
     * @param int $hopcount
     * @param string $info
     * @return string
     */
    public function ircServer($servername, $hopcount, $info)
    {
        return $this->getIrcMessage('SERVER', array($servername, $hopcount, $info));
    }

    /**
     * Returns an OPER message.
     *
     * @param string $user
     * @param string $password
     * @return string
     */
    public function ircOper($user, $password)
    {
        return $this->getIrcMessage('OPER', array($user, $password));
    }

    /**
     * Returns a QUIT message.
     *
     * @param string $message
     * @return string
     */
    public function ircQuit($message = null)
    {
        return $this->getIrcMessage('QUIT', array($message));
    }

    /**
     * Returns an SQUIT message.
     *
     * @param string $server
     * @param string $comment
     * @return string
     */
    public function ircSquit($server, $comment)
    {
        return $this->getIrcMessage('SQUIT', array($server, $comment));
    }

    /**
     * Returns a JOIN message.
     *
     * @param string $channels
     * @param string $keys
     * @return string
     */
    public function ircJoin($channels, $keys = null)
    {
        return $this->getIrcMessage('JOIN', array($channels, $keys));
    }

    /**
     * Returns a PART message.
     *
     * @param string $channels
     * @param string $message
     * @return string
     */
    public function ircPart($channels, $message = null)
    {
        return $this->getIrcMessage('PART', array($channels, $message));
    }

    /**
     * Returns a MODE message.
     *
     * @param string $target
     * @param string|null $mode
     * @param string|null $param
     * @return string
     */
    public function ircMode($target, $mode = null, $param = null)
    {
        return $this->getIrcMessage('MODE', array($target, $mode, $param));
    }

    /**
     * Returns a TOPIC message.
     *
     * @param string $channel
     * @param string $topic
     * @return string
     */
    public function ircTopic($channel, $topic = null)
    {
        return $this->getIrcMessage('TOPIC', array($channel, $topic));
    }

    /**
     * Returns a NAMES message.
     *
     * @param string $channels
     * @return string
     */
    public function ircNames($channels)
    {
        return $this->getIrcMessage('NAMES', array($channels));
    }

    /**
     * Returns a LIST message.
     *
     * @param string $channels
     * @param string $server
     * @return string
     */
    public function ircList($channels = null, $server = null)
    {
        return $this->getIrcMessage('LIST', array($channels, $server));
    }

    /**
     * Returns an INVITE message.
     *
     * @param string $nickname
     * @param string $channel
     * @return string
     */
    public function ircInvite($nickname, $channel)
    {
        return $this->getIrcMessage('INVITE', array($nickname, $channel));
    }

    /**
     * Returns a KICK message.
     *
     * @param string $channel
     * @param string $user
     * @param string $comment
     * @return string
     */
    public function ircKick($channel, $user, $comment = null)
    {
        return $this->getIrcMessage('KICK', array($channel, $user, $comment));
    }

    /**
     * Returns a VERSION message.
     *
     * @param string $server
     * @return string
     */
    public function ircVersion($server = null)
    {
        return $this->getIrcMessage('VERSION', array($server));
    }

    /**
     * Returns a STATS message.
     *
     * @param string $query
     * @param string $server
     * @return string
     */
    public function ircStats($query, $server = null)
    {
        return $this->getIrcMessage('STATS', array($query, $server));
    }

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
     */
    public function ircLinks($servermask = null, $remoteserver = null)
    {
        return $this->getIrcMessage('LINKS', array($remoteserver, $servermask));
    }

    /**
     * Returns a TIME message.
     *
     * @param string $server
     * @return string
     */
    public function ircTime($server = null)
    {
        return $this->getIrcMessage('TIME', array($server));
    }

    /**
     * Returns a CONNECT message.
     *
     * @param string $targetserver
     * @param int $port
     * @param string $remoteserver
     * @return string
     */
    public function ircConnect($targetserver, $port = null, $remoteserver = null)
    {
        return $this->getIrcMessage('CONNECT', array($targetserver, $port, $remoteserver));
    }

    /**
     * Returns a TRACE message.
     *
     * @param string $server
     * @return string
     */
    public function ircTrace($server = null)
    {
        return $this->getIrcMessage('TRACE', array($server));
    }

    /**
     * Returns an ADMIN message.
     *
     * @param string $server
     * @return string
     */
    public function ircAdmin($server = null)
    {
        return $this->getIrcMessage('ADMIN', array($server));
    }

    /**
     * Returns an INFO message.
     *
     * @param string $server
     * @return string
     */
    public function ircInfo($server = null)
    {
        return $this->getIrcMessage('INFO', array($server));
    }

    /**
     * Returns a PRIVMSG message.
     *
     * @param string $receivers
     * @param string $text
     * @return string
     */
    public function ircPrivmsg($receivers, $text)
    {
        return $this->getIrcMessage('PRIVMSG', array($receivers, $text));
    }

    /**
     * Returns a NOTICE message.
     *
     * @param string $nickname
     * @param string $text
     * @return string
     */
    public function ircNotice($nickname, $text)
    {
        return $this->getIrcMessage('NOTICE', array($nickname, $text));
    }

    /**
     * Returns a WHO message.
     *
     * @param string $name
     * @param string $o
     * @return string
     */
    public function ircWho($name, $o = null)
    {
        return $this->getIrcMessage('WHO', array($name, $o));
    }

    /**
     * Returns a WHOIS message.
     *
     * @param string $nickmasks
     * @param string $server
     * @return string
     */
    public function ircWhois($nickmasks, $server = null)
    {
        return $this->getIrcMessage('WHOIS', array($server, $nickmasks));
    }

    /**
     * Returns a WHOWAS message.
     *
     * @param string $nickname
     * @param int $count
     * @param string $server
     * @return string
     */
    public function ircWhowas($nickname, $count = null, $server = null)
    {
        return $this->getIrcMessage('WHOWAS', array($nickname, $count, $server));
    }

    /**
     * Returns a KILL message.
     *
     * @param string $nickname
     * @param string $comment
     * @return string
     */
    public function ircKill($nickname, $comment)
    {
        return $this->getIrcMessage('KILL', array($nickname, $comment));
    }

    /**
     * Returns a PING message.
     *
     * @param string $server1
     * @param string $server2
     * @return string
     */
    public function ircPing($server1, $server2 = null)
    {
        return $this->getIrcMessage('PING', array($server1, $server2));
    }

    /**
     * Returns a PONG message.
     *
     * @param string $daemon
     * @param string $daemon2
     * @return string
     */
    public function ircPong($daemon, $daemon2 = null)
    {
        return $this->getIrcMessage('PONG', array($daemon, $daemon2));
    }

    /**
     * Returns an ERROR message.
     *
     * @param string $message
     * @return string
     */
    public function ircError($message)
    {
        return $this->getIrcMessage('ERROR', array($message));
    }

    /**
     * Returns an AWAY message.
     *
     * @param string $message
     * @return string
     */
    public function ircAway($message = null)
    {
        return $this->getIrcMessage('AWAY', array($message));
    }

    /**
     * Returns a REHASH message.
     *
     * @return string
     */
    public function ircRehash()
    {
        return $this->getIrcMessage('REHASH');
    }

    /**
     * Returns a RESTART message.
     *
     * @return string
     */
    public function ircRestart()
    {
        return $this->getIrcMessage('RESTART');
    }

    /**
     * Returns a SUMMON message.
     *
     * @param string $user
     * @param string $server
     * @return string
     */
    public function ircSummon($user, $server = null)
    {
        return $this->getIrcMessage('SUMMON', array($user, $server));
    }

    /**
     * Returns a USERS message.
     *
     * @param string $server
     * @return string
     */
    public function ircUsers($server = null)
    {
        return $this->getIrcMessage('USERS', array($server));
    }

    /**
     * Returns a WALLOPS message.
     *
     * @param string $text
     * @return string
     */
    public function ircWallops($text)
    {
        return $this->getIrcMessage('WALLOPS', array($text));
    }

    /**
     * Returns a USERHOST message.
     *
     * @param string $nickname1
     * @param string $nickname2
     * @param string $nickname3
     * @param string $nickname4
     * @param string $nickname5
     * @return string
     */
    public function ircUserhost($nickname1, $nickname2 = null, $nickname3 = null, $nickname4 = null, $nickname5 = null)
    {
        return $this->getIrcMessage('USERHOST', array($nickname1, $nickname2, $nickname3, $nickname4, $nickname5));
    }

    /**
     * Returns an ISON message.
     *
     * @param string $nicknames
     * @return string
     */
    public function ircIson($nicknames)
    {
        return $this->getIrcMessage('ISON', array($nicknames));
    }

    /**
     * Returns a PROTOCTL message.
     *
     * @param string $proto
     * @return string
     */
    public function ircProtoctl($proto)
    {
        return $this->getIrcMessage('PROTOCTL', array($proto));
    }

    /**
     * Returns a CTCP request.
     *
     * @param string $receivers
     * @param string $message
     * @return string
     */
    protected function getCtcpRequest($receivers, $message)
    {
        return $this->ircPrivmsg($receivers, "\001" . $message . "\001");
    }

    /**
     * Returns a CTCP response.
     *
     * @param string $receivers
     * @param string $message
     * @return string
     */
    protected function getCtcpResponse($receivers, $message)
    {
        return $this->ircNotice($receivers, "\001" . $message . "\001");
    }

    /**
     * Returns a CTCP FINGER message.
     *
     * @param string $receivers
     * @return string
     */
    public function ctcpFinger($receivers)
    {
        return $this->getCtcpRequest($receivers, 'FINGER');
    }

    /**
     * Returns a CTCP FINGER reply message.
     *
     * @param string $nickname
     * @param string $text
     * @return string
     */
    public function ctcpFingerResponse($nickname, $text)
    {
        return $this->getCtcpResponse($nickname, 'FINGER ' . $text);
    }

    /**
     * Returns a CTCP VERSION message.
     *
     * @param string $receivers
     * @return string
     */
    public function ctcpVersion($receivers)
    {
        return $this->getCtcpRequest($receivers, 'VERSION');
    }

    /**
     * Returns a CTCP VERSION reply message.
     *
     * @param string $nickname
     * @param string $name
     * @param string $version
     * @param string $environment
     * @return string
     */
    public function ctcpVersionResponse($nickname, $name, $version, $environment)
    {
        return $this->getCtcpResponse($nickname, 'VERSION ' . $name . ':' . $version . ':' . $environment);
    }

    /**
     * Returns a CTCP SOURCE message.
     *
     * @param string $receivers
     * @return string
     */
    public function ctcpSource($receivers)
    {
        return $this->getCtcpRequest($receivers, 'SOURCE');
    }

    /**
     * Returns a CTCP SOURCE reply message.
     *
     * @param string $nickname
     * @param string $host
     * @param string $directories
     * @param string $files
     * @return string
     */
    public function ctcpSourceResponse($nickname, $host, $directories, $files)
    {
        return $this->getCtcpResponse($nickname, 'SOURCE ' . $host . ':' . $directories . ':' . $files);
    }

    /**
     * Returns a CTCP USERINFO message.
     *
     * @param string $receivers
     * @return string
     */
    public function ctcpUserinfo($receivers)
    {
        return $this->getCtcpRequest($receivers, 'USERINFO');
    }

    /**
     * Returns a CTCP USERINFO reply message.
     *
     * @param string $nickname
     * @param string $text
     * @return string
     */
    public function ctcpUserinfoResponse($nickname, $text)
    {
        return $this->getCtcpResponse($nickname, 'USERINFO ' . $text);
    }

    /**
     * Returns a CTCP CLIENTINFO message.
     *
     * @param string $receivers
     * @return string
     */
    public function ctcpClientinfo($receivers)
    {
        return $this->getCtcpRequest($receivers, 'CLIENTINFO');
    }

    /**
     * Returns a CTCP CLIENTINFO reply message.
     *
     * @param string $nickname
     * @param string $client
     * @return string
     */
    public function ctcpClientinfoResponse($nickname, $client)
    {
        return $this->getCtcpResponse($nickname, 'CLIENTINFO ' . $client);
    }

    /**
     * Returns a CTCP ERRMSG message.
     *
     * @param string $receivers
     * @param string $query
     * @return string
     */
    public function ctcpErrmsg($receivers, $query)
    {
        return $this->getCtcpRequest($receivers, 'ERRMSG ' . $query);
    }

    /**
     * Returns a CTCP ERRMSG reply message.
     *
     * @param string $nickname
     * @param string $query
     * @param string $message
     * @return string
     */
    public function ctcpErrmsgResponse($nickname, $query, $message)
    {
        return $this->getCtcpResponse($nickname, 'ERRMSG ' . $query . ' :' . $message);
    }

    /**
     * Returns a CTCP PING message.
     *
     * @param string $receivers
     * @param int $timestamp
     * @return string
     */
    public function ctcpPing($receivers, $timestamp)
    {
        return $this->getCtcpRequest($receivers, 'PING ' . $timestamp);
    }

    /**
     * Returns a CTCP PING reply message.
     *
     * @param string $nickname
     * @param int $timestamp
     * @return string
     */
    public function ctcpPingResponse($nickname, $timestamp)
    {
        return $this->getCtcpResponse($nickname, 'PING ' . $timestamp);
    }

    /**
     * Returns a CTCP TIME message.
     *
     * @param string $receivers
     * @return string
     */
    public function ctcpTime($receivers)
    {
        return $this->getCtcpRequest($receivers, 'TIME');
    }

    /**
     * Returns a CTCP TIME reply message.
     *
     * @param string $nickname
     * @param string $time
     * @return string
     */
    public function ctcpTimeResponse($nickname, $time)
    {
        return $this->getCtcpResponse($nickname, 'TIME ' . $time);
    }

    /**
     * Returns a CTCP ACTION message.
     *
     * @param string $receivers
     * @param string $action
     * @return string
     */
    public function ctcpAction($receivers, $action)
    {
        return $this->getCtcpRequest($receivers, 'ACTION ' . $action);
    }

    /**
     * Returns a CTCP ACTION reply message.
     *
     * @param string $nickname
     * @param string $action
     * @return string
     */
    public function ctcpActionResponse($nickname, $action)
    {
        return $this->getCtcpResponse($nickname, 'ACTION ' . $action);
    }
}
