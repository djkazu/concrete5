<?
namespace Concrete\Controller\Dialog\File;
use \Concrete\Controller\Backend\UI as BackendInterfaceController;
use FilePermissions;
use Loader;
use \Concrete\Controller\Search\Files as SearchFilesController;
class Search extends BackendInterfaceController {

	protected $viewPath = '/system/dialogs/file/search';

	protected function canAccess() {
		$cp = FilePermissions::getGlobal();
		if ((!$cp->canAddFile()) && (!$cp->canSearchFiles())) {
			return false;
		}
		return true;
	}

	public function view() {
		$cnt = new SearchFilesController();
		$cnt->search();
		$result = Loader::helper('json')->encode($cnt->getSearchResultObject()->getJSONObject());
		$this->set('result', $result);
		$this->set('searchController', $cnt);
	}

}

