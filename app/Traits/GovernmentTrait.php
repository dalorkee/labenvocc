<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Log};
use App\Models\{Government,GovernmentDept};

trait GovernmentTrait {
	public function getGovernmentToArray(): array {
		try {
			$govs = Government::select('id', 'gov_name')->get();
			$govsArr = array();
			$govs->each(function($item, $key) use (&$govsArr) {
				$govsArr[$item->id] = $item->gov_name;
			});
			return $govsArr;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getGovernmentNameById($id=0): ?string {
        $gov = (!empty($id)) ? Government::select('gov_name')->whereId($id)->get() : null;
		return $gov[0]->gov_name ?? null;
	}

	public function getDepartmentNameById($id=0): ?string {
		$dept = (!empty($id)) ? GovernmentDept::select('gov_dept_name')->whereId($id)->get() : null;
		return $dept[0]->gov_dept_name ?? null;
	}

	public function getGovernmentDeptToArray(): array {
		try {
			$govDepts = GovernmentDept::select('id', 'gov_dept_name')->get();
			$govDeptArr = array();
			$govDepts->each(function($item, $key) use (&$govDeptArr) {
				$govDeptArr[$item->id] = $item->gov_dept_name;
			});
			return $govDeptArr;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getGovernmentDeptByGovId($gov_id): array {
		try {
			$govDeps = GovernmentDept::select('id', 'gov_dept_name')->whereRef_gov_id($gov_id)->get();
			$govDepsArr = array();
			$govDeps->each(function($item, $key) use (&$govDepsArr) {
				$govDepsArr[$item->id] = $item->gov_dept_name;
			});
			return $govDepsArr;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function renderGovernmentDeptToHtmlSelect(Request $request): string {
		try {
			$depts = $this->getGovernmentDeptByGovId($request->id);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($depts as $key => $val) {
				$htm .= "<option value=\"".$key."\">".$val."</option>";
			}
			return $htm;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function renderGovernmentDeptToHtmlSelectV2(Request $request): string {
		try {
			$depts = $this->getGovernmentDeptByGovId($request->id);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($depts as $key => $val) {
				$htm .= "<option value=\"".$key."|".$val."\">".$val."</option>";
			}
			return $htm;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

}
?>
