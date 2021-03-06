angular.module('app.controllers')
	.controller('ProjectMemberRemoveController', [
		'$scope', '$location', '$routeParams', 'ProjectMember',
		function($scope, $location, $routeParams, ProjectMember) {
			$scope.projectMember = ProjectMember.get({
				id: $routeParams.id,
				idMember: $routeParams.idMember
			});

			$scope.remove = function () {
				$scope.projectMember.$delete({
					id: $scope.projectMember.project_id,
					idMember: $scope.projectMember.user_id}
				).then(function () {
					$location.path('/project/'+$routeParams.id+'/members');
				});
			}
		}
	]);