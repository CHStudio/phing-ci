<?php
/**
 * Phing Task: Apply an xpath on a given XML and export result in property
 *
 * @author Stéphane HULARD <s.hulard@chstudio.fr>
 * @copyright CHStudio 2015
 */
class XpathTask extends Task
{
    private $xpath;
    private $path;
    private $property;

    /**
     * Task Launcher
     * @return void
     */
    public function main()
    {
        $xml = simplexml_load_file($this->path);
        list($ret) = $xml->xpath($this->xpath);

        $this->project->setProperty($this->property, (string)$ret);
    }

    /**
     * Init returnProperty property
     * @return void
     */
    public function setProperty($prop)
    {
        $this->property = $prop;
    }

    /**
     * Init xpath property
     * @return void
     */
    public function setXpath($xpath)
    {
        $this->xpath = $xpath;
    }

    /**
     * Init path property
     * @return void
     */
    public function setPath($path)
    {
        $path = !is_dir(dirname($path))?
            $this->location.DIRECTORY_SEPARATOR.$path:
            $path;
        if (!is_file($path)) {
            throw new Exception('Invalid path given!');
        }
        $this->path = $path;
    }
}
