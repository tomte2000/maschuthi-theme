function myColumnBgColorOptions( bgColorOptions ) {
  
  var colors = wp_custom_vars.colors; //werden in funtions.php definiert....
  var bgColorOptions = [];
  for (var color in colors) {
      // skip loop if the property is from prototype
      if (!colors.hasOwnProperty(color)) continue;
      bgColorOptions.push({name:'has-' +color + '-background-color', color:colors[color]})
  }
  //console.log(bgColorOptions);
  return bgColorOptions;
}

wp.hooks.addFilter('wpBootstrapBlocks.column.bgColorOptions','myplugin/wp-bootstrap-blocks/column/bgColorOptions',myColumnBgColorOptions);
