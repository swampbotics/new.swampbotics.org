module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'webroot/assets/css/custom/custom.css': 'webroot/assets/css/custom/custom.sass'
                }
            }
        },
        autoprefixer: {
            dist: {
                files: {
                    'webroot/assets/css/custom/custom.css': 'webroot/assets/css/custom/custom.css'
                }
            }
        },
        watch: {
            css: {
                files: 'webroot/assets/css/custom/*.sass',
                tasks: ['sass', 'autoprefixer']
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.registerTask('default', ['watch']);
}
