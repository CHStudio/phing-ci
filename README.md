phing-ci
========

A collection of Phing buildfiles and Tasks used for continuous integration

Installing
----------

This project can be installed through Composer. Add the following to your composer.json:

```JSON
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/chstudio/phing-ci"
        }
    ],
    "require": {
        "chstudio/phing-ci": "~1.0"
    }
}
```

Usage
-----

Configuration are stored inside the `build.dist.properties` file at project root.
You can extend it by creating a `build.properties` file and override the updated values.

Then you can get the task list with :

```bash
> vendor/bin/phing -l
Buildfile: /an/awesome/path/to/the/project/build.xml
      [php] Calling PHP function: constant()
 [property] Loading /an/awesome/path/to/the/project/build.dist.properties
      [php] Calling PHP function: constant()
Default target:
-------------------------------------------------------------------------------
 help

Main targets:
-------------------------------------------------------------------------------
 solr:clean        Cleanup SolR instance files
 solr:clean:cores  Cleanup SolR instance files
 solr:core:new     Create a new core in current SolR instance
 solr:core:reload  Reload a specified core from current SolR instance
 solr:core:remove  Remove a specified core from current SolR instance
 solr:core:update  Update a solr core in current SolR instance
 solr:install      Install SolR on the current instance
 solr:start        Start the SolR running instance
 solr:stop         Stop the SolR running instance

Subtargets:
-------------------------------------------------------------------------------
 help
 secure:properties
 solr.help
```

And you can run one of the tasks :

```bash
> vendor/bin/phing solr:install
```
