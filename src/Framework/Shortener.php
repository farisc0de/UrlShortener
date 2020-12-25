<?php

namespace Framework;

class Shortener
{
    private $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    public $use_custom_code = false;

    public $custom_code;

    public $link_protected = false;

    public $password;

    private $checkUrlExists = false;

    /**
     * Undocumented variable
     *
     * @var Database
     */
    private $db;

    protected $timestamp;

    public function __construct($db)
    {
        $this->db = $db;
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function urlToShortCode($url)
    {
        if (empty($url)) {
            throw new \Exception("No URL was supplied.");
        }

        if ($this->validateUrlFormat($url) == false) {
            throw new \Exception("URL does not have a valid format.");
        }

        if ($this->checkUrlExists) {
            if (!$this->verifyUrlExists($url)) {
                throw new \Exception("URL does not appear to exist.");
            }
        }

        $shortCode = $this->urlExistsInDB($url);

        if ($shortCode == false) {
            $shortCode = $this->createShortCode($url);
        }

        return $shortCode;
    }

    public function validateUrlFormat($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public function verifyUrlExists($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (!empty($response) && $response != 404);
    }

    public function urlExistsInDB($url)
    {
        $this->db->query("SELECT short_code FROM short_urls WHERE long_url = :long_url
        LIMIT 1");

        $this->db->bind(":long_url", $url, \PDO::PARAM_STR);

        if ($this->db->execute()) {
            $result = $this->db->single();
            return (empty($result)) ? false : $result->short_code;
        }
    }

    public function createShortCode($url)
    {
        $shortCode = $this->use_custom_code ?
            $this->custom_code :
            $this->generateRandomString();

        $password = $this->link_protected ?
            password_hash($this->password, PASSWORD_BCRYPT) :
            null;

        $this->insertUrlInDB($url, $shortCode, $password);
        return $shortCode;
    }

    public function generateRandomString($length = 7)
    {
        $characters = $this->chars;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function insertUrlInDB($url, $code, $password = null)
    {
        $this->db->query("INSERT INTO short_urls (long_url, short_code, password, hits, created)
        VALUES (:long_url,:short_code, :password, :hits, :timestamp)");

        $this->db->bind(":long_url", $url, \PDO::PARAM_STR);
        $this->db->bind(":short_code", $code, \PDO::PARAM_STR);
        $this->db->bind(":password", $password);
        $this->db->bind(":hits", 0, \PDO::PARAM_INT);
        $this->db->bind(":timestamp", $this->timestamp, \PDO::PARAM_STR);

        $this->db->execute();
    }

    public function shortCodeToUrl($code, $increment = true)
    {
        if (empty($code)) {
            throw new \Exception("No short code was supplied.");
        }

        if ($this->validateShortCode($code) == false) {
            throw new \Exception("Short code does not have a valid format.");
        }

        $urlRow = $this->getUrlFromDB($code);
        if (empty($urlRow)) {
            throw new \Exception("Short code does not appear to exist.");
        }

        if ($increment == true) {
            $this->incrementCounter($urlRow->id);
        }

        return $urlRow->long_url;
    }

    public function validateShortCode($code)
    {
        return preg_match("|[" . $this->chars . "]+|", $code);
    }

    public function getUrlFromDB($code)
    {
        $this->db->query("SELECT id, long_url FROM short_urls WHERE short_code =
        :short_code LIMIT 1");

        $this->db->bind(":short_code", $code, \PDO::PARAM_STR);

        if ($this->db->execute()) {
            return $this->db->single();
        }
    }

    public function incrementCounter($id)
    {
        $this->db->query("UPDATE short_urls SET hits = hits + 1 WHERE id = :id");

        $this->db->bind(":id", $id, \PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function setCheckUrlExists($bool)
    {
        $this->checkUrlExists = $bool;
    }

    public function checkPassword($code, $password)
    {
        $sql = "SELECT password FROM short_urls WHERE short_code = :code";

        $this->db->query($sql);

        $this->db->bind(":code", $code, \PDO::PARAM_STR);

        $this->db->execute();

        $data = $this->db->single();

        return password_verify($password, $data->password);
    }

    public function is_protected($code)
    {
        $sql = "SELECT password FROM short_urls WHERE short_code = :code";

        $this->db->query($sql);

        $this->db->bind(":code", $code, \PDO::PARAM_STR);

        $this->db->execute();

        $data = $this->db->single();

        return ($data->password != null) ? true : false;
    }

    public function getUrlInfoFromDb($code)
    {
        $sql = "SELECT * FROM short_urls WHERE short_code = :code";

        $this->db->query($sql);

        $this->db->bind(":code", $code, \PDO::PARAM_STR);

        $this->db->execute();

        return $this->db->single();
    }
}
