'use strict';
module.exports = function(grunt) {

    // load all grunt tasks matching the `grunt-*` pattern
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

        phpunit: {
            'default': {
                cmd: 'phpunit',
                args: ['-c', 'phpunit.xml']
            },
        },
    });



    // Register tasks
    // Testing tasks.
    grunt.registerMultiTask( 'phpunit', 'Runs PHPUnit tests, including the ajax and multisite tests.', function() {
        grunt.util.spawn( {
            args: this.data.args,
            cmd:  this.data.cmd,
            opts: { stdio: 'inherit' }
        }, this.async() );
    });
	// Typical run, cleans up css and js 
    grunt.registerTask('default', ['phpunit']);

};