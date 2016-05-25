module.exports = function(grunt) {
    require('jit-grunt')(grunt);
    grunt.loadNpmTasks('grunt-postcss');

    grunt.initConfig({
	less: {
	    development: {
		options: {
		    compress: true,
		    yuicompress: true,
		    optimization: 2
		},
		files: {
		    "./css/style.css": "less/style.less" // destination file and source file
		}
	    }
	},
	postcss: {
	    options: {
                map: true,
                processors: [
                    require('autoprefixer')({
                        browsers: ['last 2 versions']
                    })
                ]
            },
            dist: {
                src: 'style.css'
            }
	},
	watch: {
	    styles: {
		files: ['less/**/*.less'], // which files to watch
		tasks: ['buildless'],
		options: {
		    nospawn: true
		}
	    }
	}
    });

    grunt.registerTask('buildless', ['less','postcss']);
    grunt.registerTask('default', ['buildless', 'watch']);
};
