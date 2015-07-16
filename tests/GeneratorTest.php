<?php
/**
 * Phergie (http://phergie.org)
 *
 * @link http://github.com/phergie/phergie-irc-generator for the canonical source repository
 * @copyright Copyright (c) 2008-2014 Phergie Development Team (http://phergie.org)
 * @license http://phergie.org/license Simplified BSD License
 * @package Phergie\Irc
 */

namespace Phergie\Irc\Tests;

use Phergie\Irc\Generator;

/**
 * Tests for \Phergie\Irc\Generator.
 *
 * @category Phergie
 * @package Phergie\Irc
 */
class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of the class being tested
     *
     * @var \Phergie\Irc\Generator
     */
    protected $generator;

    /**
     * Instantiates the class being tested.
     */
    protected function setUp()
    {
        $this->generator = new Generator;
    }

    /**
     * Tests a single message generation method call without a prefix set.
     *
     * @param string $method Method to call
     * @param string $return Expected return value
     * @param array $args Optional arguments to pass to the method
     * @dataProvider dataProviderTestGenerationMethod
     */
    public function testGenerationMethodsWithoutPrefix($method, $return, array $args = array())
    {
        $this->assertSame($return, call_user_func_array(array($this->generator, $method), $args));
    }

    /**
     * Tests a single message generation method call with a prefix set.
     *
     * @param string $method Method to call
     * @param string $return Expected return value
     * @param array $args Optional arguments to pass to the method
     * @dataProvider dataProviderTestGenerationMethod
     */
    public function testGenerationMethodsWithPrefix($method, $return, array $args = array())
    {
        $this->generator->setPrefix('nick!user@host');
        $this->assertSame(':nick!user@host ' . $return, call_user_func_array(array($this->generator, $method), $args));
    }

    /**
     * Data provider for testing generation methods.
     *
     * @return array
     */
    public function dataProviderTestGenerationMethod()
    {
        return array(

            array('ircPass', "PASS :password\r\n", array('password')),

            array('ircNick', "NICK :nickname\r\n", array('nickname')),
            array('ircNick', "NICK nickname :2\r\n", array('nickname', '2')),

            array('ircUser', "USER username hostname servername :realname\r\n", array('username', 'hostname', 'servername', 'realname')),
            array('ircUser', "USER username 0 0 :realname\r\n", array('username', '0', '0', 'realname')),

            array('ircServer', "SERVER servername 2 :info\r\n", array('servername', '2', 'info')),

            array('ircOper', "OPER user :password\r\n", array('user', 'password')),

            array('ircQuit', "QUIT\r\n"),
            array('ircQuit', "QUIT :message\r\n", array('message')),

            array('ircSquit', "SQUIT server :comment\r\n", array('server', 'comment')),

            array('ircJoin', "JOIN :#channel\r\n", array('#channel')),
            array('ircJoin', "JOIN #channel :key\r\n", array('#channel', 'key')),

            array('ircPart', "PART :#channel\r\n", array('#channel')),
            array('ircPart', "PART #channel :message\r\n", array('#channel', 'message')),

            array('ircMode', "MODE #channel :-s\r\n", array('#channel', '-s')),
            array('ircMode', "MODE #channel l :2\r\n", array('#channel', 'l', '2')),
            array('ircMode', "MODE nickname :+i\r\n", array('nickname', '+i')),
            array('ircMode', "MODE :#channel\r\n", array('#channel')),

            array('ircTopic', "TOPIC :#channel\r\n", array('#channel')),
            array('ircTopic', "TOPIC #channel :topic\r\n", array('#channel', 'topic')),

            array('ircNames', "NAMES :#channel\r\n", array('#channel')),

            array('ircList', "LIST :#channel\r\n", array('#channel')),
            array('ircList', "LIST #channel :server\r\n", array('#channel', 'server')),

            array('ircInvite', "INVITE nickname :#channel\r\n", array('nickname', '#channel')),

            array('ircKick', "KICK #channel :user\r\n", array('#channel', 'user')),
            array('ircKick', "KICK #channel user :comment\r\n", array('#channel', 'user', 'comment')),

            array('ircVersion', "VERSION\r\n"),
            array('ircVersion', "VERSION :server\r\n", array('server')),

            array('ircStats', "STATS :query\r\n", array('query')),
            array('ircStats', "STATS query :server\r\n", array('query', 'server')),

            array('ircLinks', "LINKS\r\n"),
            array('ircLinks', "LINKS :servermask\r\n", array('servermask')),
            array('ircLinks', "LINKS remoteserver :servermask\r\n", array('servermask', 'remoteserver')),

            array('ircTime', "TIME\r\n"),
            array('ircTime', "TIME :server\r\n", array('server')),

            array('ircConnect', "CONNECT :targetserver\r\n", array('targetserver')),
            array('ircConnect', "CONNECT targetserver :6667\r\n", array('targetserver', '6667')),
            array('ircConnect', "CONNECT targetserver 6667 :remoteserver\r\n", array('targetserver', '6667', 'remoteserver')),

            array('ircTrace', "TRACE\r\n"),
            array('ircTrace', "TRACE :server\r\n", array('server')),

            array('ircAdmin', "ADMIN\r\n"),
            array('ircAdmin', "ADMIN :server\r\n", array('server')),

            array('ircInfo', "INFO\r\n"),
            array('ircInfo', "INFO :server\r\n", array('server')),

            array('ircPrivmsg', "PRIVMSG receivers :text\r\n", array('receivers', 'text')),

            array('ircNotice', "NOTICE nickname :text\r\n", array('nickname', 'text')),

            array('ircWho', "WHO :name\r\n", array('name')),
            array('ircWho', "WHO name :o\r\n", array('name', 'o')),

            array('ircWhois', "WHOIS server :nickmasks\r\n", array('nickmasks', 'server')),

            array('ircWhowas', "WHOWAS :nickname\r\n", array('nickname')),
            array('ircWhowas', "WHOWAS nickname :2\r\n", array('nickname', '2')),
            array('ircWhowas', "WHOWAS nickname 2 :server\r\n", array('nickname', '2', 'server')),

            array('ircKill', "KILL nickname :comment\r\n", array('nickname', 'comment')),

            array('ircPing', "PING :server1\r\n", array('server1')),
            array('ircPing', "PING server1 :server2\r\n", array('server1', 'server2')),

            array('ircPong', "PONG :daemon\r\n", array('daemon')),
            array('ircPong', "PONG daemon :daemon2\r\n", array('daemon', 'daemon2')),

            array('ircError', "ERROR :message\r\n", array('message')),

            array('ircAway', "AWAY\r\n"),
            array('ircAway', "AWAY :message\r\n", array('message')),

            array('ircRehash', "REHASH\r\n"),

            array('ircRestart', "RESTART\r\n"),

            array('ircSummon', "SUMMON :user\r\n", array('user')),
            array('ircSummon', "SUMMON user :server\r\n", array('user', 'server')),

            array('ircUsers', "USERS\r\n"),
            array('ircUsers', "USERS :server\r\n", array('server')),

            array('ircWallops', "WALLOPS :text\r\n", array('text')),

            array('ircUserhost', "USERHOST :nickname1\r\n", array('nickname1')),
            array('ircUserhost', "USERHOST nickname1 :nickname2\r\n", array('nickname1', 'nickname2')),
            array('ircUserhost', "USERHOST nickname1 nickname2 :nickname3\r\n", array('nickname1', 'nickname2', 'nickname3')),
            array('ircUserhost', "USERHOST nickname1 nickname2 nickname3 :nickname4\r\n", array('nickname1', 'nickname2', 'nickname3', 'nickname4')),
            array('ircUserhost', "USERHOST nickname1 nickname2 nickname3 nickname4 :nickname5\r\n", array('nickname1', 'nickname2', 'nickname3', 'nickname4', 'nickname5')),

            array('ircIson', "ISON :nicknames\r\n", array('nicknames')),

            array('ircProtoctl', "PROTOCTL :NAMESX\r\n", array('NAMESX')),

            array('ctcpFinger', "PRIVMSG receivers :\001FINGER\001\r\n", array('receivers')),

            array('ctcpFingerResponse', "NOTICE nickname :\001FINGER text\001\r\n", array('nickname', 'text')),

            array('ctcpVersion', "PRIVMSG receivers :\001VERSION\001\r\n", array('receivers')),

            array('ctcpVersionResponse', "NOTICE nickname :\001VERSION name:version:environment\001\r\n", array('nickname', 'name', 'version', 'environment')),

            array('ctcpSource', "PRIVMSG receivers :\001SOURCE\001\r\n", array('receivers')),

            array('ctcpSourceResponse', "NOTICE nickname :\001SOURCE host:directories:files\001\r\n", array('nickname', 'host', 'directories', 'files')),

            array('ctcpUserinfo', "PRIVMSG receivers :\001USERINFO\001\r\n", array('receivers')),

            array('ctcpUserinfoResponse', "NOTICE nickname :\001USERINFO text\001\r\n", array('nickname', 'text')),

            array('ctcpClientinfo', "PRIVMSG receivers :\001CLIENTINFO\001\r\n", array('receivers')),

            array('ctcpClientinfoResponse', "NOTICE nickname :\001CLIENTINFO client\001\r\n", array('nickname', 'client')),

            array('ctcpErrmsg', "PRIVMSG receivers :\001ERRMSG query\001\r\n", array('receivers', 'query')),

            array('ctcpErrmsgResponse', "NOTICE nickname :\001ERRMSG query :message\001\r\n", array('nickname', 'query', 'message')),

            array('ctcpPing', "PRIVMSG receivers :\001PING timestamp\001\r\n", array('receivers', 'timestamp')),

            array('ctcpPingResponse', "NOTICE nickname :\001PING timestamp\001\r\n", array('nickname', 'timestamp')),

            array('ctcpTime', "PRIVMSG receivers :\001TIME\001\r\n", array('receivers')),

            array('ctcpTimeResponse', "NOTICE nickname :\001TIME time\001\r\n", array('nickname', 'time')),

            array('ctcpAction', "PRIVMSG receivers :\001ACTION action\001\r\n", array('receivers', 'action')),

            array('ctcpActionResponse', "NOTICE nickname :\001ACTION action\001\r\n", array('nickname', 'action')),

        );
    }
}
