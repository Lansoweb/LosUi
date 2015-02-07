module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		uglify : {
			build : {
				files : [ {
					expand : true,
					cwd : 'moment/locale',
					src : '**/*.js',
					dest : 'moment/min/locale',
					ext: '.min.js'
				} ]
			}
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');

	// Default task(s).
	grunt.registerTask('default', [ 'uglify' ]);

};