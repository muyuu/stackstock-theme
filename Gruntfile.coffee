module.exports = (grunt) ->

  # Load grunt tasks automatically
  require('load-grunt-tasks') grunt

  grunt.initConfig
    pkg: grunt.file.readJSON('package.json')

    # Bower
    bower:
      install:
        options:
          targetDir: 'libs'
          layout: 'byComponent'
          install: true
          verbose: false
          cleanTargetDir: true
          cleanBowerDir: true

    # local Server
    connect:
      server:
        options:
          port: 9000
          livereload: true
          # ブラウザでページを開く
          open: true

    # estwatch
    esteWatch:
      options:
        dirs: ["src/**/", "js/"]
        livereload:
          enabled: true
          port: 35729
          extensions: ['jade', 'js', 'sass','scss']
      jade: (filepath) ->
        # パーシャルファイルは書き出さないので
        # パーシャルファイルに変更があった場合は
        # とりあえずパーシャル以外の全ファイルを書き出す
        lastslashnum = filepath.lastIndexOf "/"
        filename = filepath.substring lastslashnum + 1, filepath.length
        if filename.indexOf("_") is 0
          filepath = ['**/*.jade', '!**/_*.jade']
        else
          filepath = filepath.replace "src/", ""

        # 改行とかつけたまま出力
        grunt.config 'jade.options.pretty', true
        grunt.config 'jade.compile.files', [
          expand : true
          src    : filepath
          cwd    : 'src/' # 対象フォルダ
          dest   : '' # コンパイルフォルダ
          ext    : '.html'
        ]
        'jade'
      coffee: (filepath) ->
        filename = filepath.replace "src/coffee/", ""
        grunt.config 'coffee.compile.options',
          bare: true
          # sourceMap: true
        grunt.config 'coffee.compile.files', [
          expand : true
          src    : filename
          cwd    : 'src/coffee/' # 対象フォルダ
          dest   : 'js/' # コンパイルフォルダ
          ext    : '.js'
        ]
        'coffee'
      js: (filepath) ->
        'jshint'
      scss: (filepath) ->
        'sass:compile'
      sass: (filepath) ->
        'sass:compile'

    # sass
    sass:
      compile:
        options:
          sourcemap: true
          style: 'expanded'
        files:
          'c/style.css': 'scss/style.scss'
      build:
        options:
          style: 'compressed'
        files:
          'c/style.css': 'scss/style.scss'

    # jshint
    jshint:
      options:
        jshintrc: '.jshintrc'
      all: [
        'js/app.js'
        'js/form.js'
      ]

    # comp
    uglify:
      build:
        files:
          "app.min.js": ["app.js"]


  # Bower Setup
  grunt.registerTask "init", ["bower:install"]
  # start local server
  grunt.registerTask "default", ["connect", "esteWatch"]
  # start watch
  grunt.registerTask "watch", ["esteWatch"]
  # build task
  grunt.registerTask "build", ["uglify:build", "sass:build"]
