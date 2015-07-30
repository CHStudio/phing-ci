<?php
/**
 * Phing Task: Get the status code of a given URL
 *
 * @author Stéphane HULARD <s.hulard@chstudio.fr>
 * @copyright CHStudio 2015
 */
class HttpStatusTask extends Task
{
    private $url;
    private $property;

    /**
     * Task Launcher
     * @return void
     */
    public function main()
    {
        $handle = curl_init($this->url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);
        curl_exec($handle);
        $status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $this->project->setProperty($this->property, $status);
    }

    /**
     * Init url property
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid URL given!');
        }
        $this->url = $url;
    }

    /**
     * Init returnProperty property
     * @return void
     */
    public function setProperty($prop)
    {
        $this->property = $prop;
    }
}
