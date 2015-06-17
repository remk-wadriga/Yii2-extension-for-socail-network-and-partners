<?php

namespace app\extensions\provider;

use OAuth\Common\Http\Uri\UriInterface;

class Uri implements UriInterface
{
    const HTTP_PORT = 80;
    const HTTPS_PORT = 443;

    private $scheme;
    private $host;
    private $port;
    private $path;
    private $query;
    private $userInfo;

    private $_url;

    public function __construct($url)
    {
        $this->setUrl($url);
    }

    public function setUrl($url)
    {
        $url = parse_url($url);

        $scheme = isset($url['scheme']) ? $url['scheme'] . '://' : 'http://';
        $port = $scheme === 'https://' ? self::HTTPS_PORT : self::HTTP_PORT;
        $host = isset($url['host']) ? $url['host'] : '';
        $path = isset($url['path']) ? $url['path'] : '';
        $query = isset($url['query']) ? '?' . $url['query'] : '';

        $this->setScheme($scheme);
        $this->setPort($port);
        $this->setHost($host);
        $this->setPath($path);
        $this->setQuery($query);
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        if ($this->scheme === null) {
            $this->scheme = $this->getPort() === self::HTTPS_PORT ? 'https://' : 'http://';
        }

        return $this->scheme;
    }

    /**
     * @param string $scheme
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        if ($this->port === null) {
            $this->port = self::HTTP_PORT;
        }

        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * Adds a param to the query string.
     *
     * @param string $var
     * @param string $val
     */
    public function addToQuery($var, $val)
    {
        if ($this->query === null) {
            $this->query = '';
        }

        $this->query .= strpos($this->query, '?') === false ? "?{$var}={$val}" : "&{$var}={$val}";
    }

    /**
     * @return string
     */
    public function getFragment()
    {

    }

    /**
     * Should return URI user info, masking protected user info data according to rfc3986-3.2.1
     *
     * @return string
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }

    /**
     * @param string $userInfo
     */
    public function setUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * Should return the URI Authority, masking protected user info data according to rfc3986-3.2.1
     *
     * @return string
     */
    public function getAuthority()
    {

    }

    /**
     * Should return the URI string, masking protected user info data according to rfc3986-3.2.1
     *
     * @return string the URI string with user protected info masked
     */
    public function __toString()
    {

    }

    /**
     * Should return the URI Authority without masking protected user info data
     *
     * @return string
     */
    public function getRawAuthority()
    {

    }

    /**
     * Should return the URI user info without masking protected user info data
     *
     * @return string
     */
    public function getRawUserInfo()
    {

    }

    /**
     * Build the full URI based on all the properties
     *
     * @return string The full URI without masking user info
     */
    public function getAbsoluteUri()
    {
        return $this->getScheme() . $this->getHost() . $this->getRelativeUri();
    }

    /**
     * Build the relative URI based on all the properties
     *
     * @return string The relative URI
     */
    public function getRelativeUri()
    {
        if ($this->_url !== null) {
            return $this->_url;
        }

        return $this->_url = $this->getPath() . $this->getQuery();
    }

    /**
     * @return bool
     */
    public function hasExplicitTrailingHostSlash()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function hasExplicitPortSpecified()
    {
        return false;
    }
}