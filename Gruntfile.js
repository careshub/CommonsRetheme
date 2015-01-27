'use strict';
module.exports = function(grunt) {

    // load all grunt tasks matching the `grunt-*` pattern
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

        // watch for changes and trigger sass, jshint, uglify and livereload
        watch: {
            options: { 
                livereload: true,
            },
            js: {
                files: '<%= jshint.all %>',
                tasks: ['uglify']
            },
            css: {
				files: ['css/*.less'],
                tasks: ['less:cleancss', 'autoprefixer']
            },
            // images: {
            //     files: ['img/**/*.{png,jpg,gif}'],
            //     tasks: ['imagemin']
            // },
            // livereload: {
            //     options: { livereload: true },
            //     files: ['style.css', 'js/*.js', 'img/**/*.{png,jpg,jpeg,gif,webp,svg}']
            // }
        },

		less: {
		  cleancss: {
			options: {
			  // paths: ["css"],
			  cleancss: true,
			},
			files: {
				"style.css": "css/style.less",
				"style-ie.css": "css/ie.less",
                "css/tinymce-editor-styles.css": "css/tinymce-editor-styles.less"
			}
		  }
		},
		
        // autoprefixer
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'],
                map: true
            },
            files: {
                expand: true,
                flatten: true,
                src: '*.css',
                dest: '' //replaces source files
            },
        },

        // css minify
        // Using less:cleancss to do this.
        // cssmin: {
        //     options: {
        //         keepSpecialComments: 1
        //     },
        //     minify: {
        //         expand: true,
        //         cwd: 'assets/styles/build',
        //         src: ['*.css', '!*.min.css'],
        //         ext: '.css'
        //     }
        // },

        // javascript linting with jshint
        jshint: {
            options: {
//                 jshintrc: '.jshintrc',
//                 "force": true
            },
            all: [
                'Gruntfile.js',
                'js/src/*.js',
                'js/libs/*.js',
            ]
        },

        // uglify to concat, minify, and make source maps
        uglify: {
			options: {
				banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
						'<%= grunt.template.today("yyyy-mm-dd") %> */'
			}, 
			common: {
				files: {
					'js/commons.min.js': [
					'js/src/*.js',
					'js/libs/*.js',
					
					]
				}
			}
        },

		checktextdomain: {
			options: {
				correct_domain: false,
				text_domain: 'cctheme',
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'_n:1,2,4d',
					'_ex:1,2c,3d',
					'_nx:1,2,4c,5d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src: '**/*.php',
				expand: true
			}
		},
		makepot: {
			target: {
				options: {
					domainPath: '/languages',
					mainFile: 'functions.php',
					potFilename: 'cc-retheme.pot',
					processPot: function( pot ) {
						pot.headers['last-translator'] = 'Community Commons <info@communitycommons.org>';
						pot.headers['language-team'] = 'ENGLISH <info@communitycommons.org>';
						return pot;
					},
					type: 'wp-theme'
				}
			}
		},

        // image optimization
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 7,
                    progressive: true,
                    interlaced: true
                },
                files: [{
                    expand: true,
                    cwd: 'img/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'img/'
                }]
            }
        },

    });



    // Register tasks
	// Typical run, cleans up css and js 
    grunt.registerTask('default', ['less:cleancss', 'autoprefixer', 'uglify:common', 'watch']);
    // Before releasing a build, do above plus minimize all images
	grunt.registerTask('build', ['less:cleancss', 'autoprefixer', 'uglify:common', 'imagemin', 'checktextdomain', 'makepot']);

};