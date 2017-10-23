const gulp = require('gulp-help')(require('gulp'));
const argv = require('yargs').argv;
const clean = require('gulp-clean');
const gutil = require('gulp-util');
const stripDebug = require('gulp-strip-debug');
const concat = require('gulp-concat-util');
const rename = require('gulp-rename');
const watch = require('gulp-watch');
const debug = require('gulp-debug');
const eol = require('os').EOL;
const uglify = require('gulp-uglify')
const ngAnnotate = require('gulp-ng-annotate')

gulp.task('clean-dist', 'Limpar pasta /dist', function() {

	gulp.src('./dist')
	.pipe(clean({force: true}));

});

gulp.task('unify-files', 'Unificar arquivos (destino:/dist/dist.js)',['clean-dist'], function() {

	var exec = require('gulp-exec');
	var options = {
	    continueOnError: false, // default = false, true means don't emit error event 
	    pipeStdout: false, // default = false, true means stdout is written to file.contents 
	    customTemplatingThing: "test" // content passed to gutil.template() 
	};
	var reportOptions = {
	  	err: true, // default = true, false means don't write err 
	  	stderr: true, // default = true, false means don't write stderr 
	  	stdout: true // default = true, false means don't write stdout 
	}


	return gulp.src([

			// UTIL MODULE
			// APP
			'./app/app.js',
			'./app/controllers/main.js',
			'./app/directives/tootip.js',			
					 

		]) 
		.pipe(concat('./dist', {newLine: eol, process: function(src, filePath) { 
	      // if you need the filename, example `myFileJs.js`, path.basename( filePath, '.js' ) 
	      return (src.trim() + '\n').replace(/(^|\n)[ \t]*('use strict'|"use strict");?\s*/g, '$1'); 
	    }})) 
	    .pipe(concat.header('(function(window, document, undefined) {\n\'use strict\';\n'))
	    .pipe(concat.footer('\n})(window, document);\n'))
		.pipe(stripDebug())	
		.pipe(ngAnnotate())
		.pipe(uglify())
		.pipe(rename('dist.js'))
		.pipe(gulp.dest('./dist'))
		.pipe(exec.reporter(reportOptions)); 



});

gulp.task('watch', 'Monitorar arquivos modificados', ['unify-files'], function() {
  gulp.watch(['app/**/*'], ['unify-files']);
  gutil.log('Listening Files...');
});


gulp.task('default', 'Limpar e Monitorar arquivos modificados',['clean-dist', 'watch']);