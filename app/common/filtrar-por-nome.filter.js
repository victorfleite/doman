angular
.module('app')
.filter('fitrarPorNome', ['$log', function($log) {
  return function(itens, search, field) {
    var listToReturn = [];
    if (search === undefined) return itens;
    angular.forEach(itens, function (item) {
      if (item[field].toLowerCase().indexOf(search.toLowerCase()) >= 0) {
        listToReturn.push(item);
      }
    });
    return listToReturn;
  };
}]);