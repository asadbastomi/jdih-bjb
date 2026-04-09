<?php

namespace App\Http\Controllers\API;

use App\BahariAiCustomAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class BahariAiCustomAnswerController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search = $request->search;

        $dataset = BahariAiCustomAnswer::query();
        if (!empty($search)) {
            $dataset->where(function ($query) use ($search) {
                $query->where('judul_admin', 'like', '%' . $search . '%')
                    ->orWhere('contoh_pertanyaan', 'like', '%' . $search . '%')
                    ->orWhere('kata_kunci', 'like', '%' . $search . '%')
                    ->orWhere('jawaban', 'like', '%' . $search . '%');
            });
        }

        $data['data'] = $dataset->orderBy('prioritas', 'desc')
            ->orderBy('id', 'asc')
            ->paginate($item);

        if ($request->ajax()) {
            return view('admin.bahari-ai-custom-answer.data', $data);
        }

        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_admin' => ['nullable', 'string', 'max:255'],
            'contoh_pertanyaan' => ['nullable', 'string', 'max:255'],
            'kata_kunci' => ['required', 'string'],
            'tipe_pencocokan' => ['required', 'in:contains,exact'],
            'jawaban' => ['required', 'string'],
            'prioritas' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = new BahariAiCustomAnswer;
        $table->judul_admin = $request->judul_admin;
        $table->contoh_pertanyaan = $request->contoh_pertanyaan;
        $table->kata_kunci = $request->kata_kunci;
        $table->tipe_pencocokan = $request->tipe_pencocokan;
        $table->jawaban = $request->jawaban;
        $table->prioritas = $request->prioritas ?? 0;
        $table->is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $table->is_active = $table->is_active ?? true;

        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        }

        return $this->sendError(null, 'Data failed to save', 500);
    }

    public function edit($id)
    {
        $table = BahariAiCustomAnswer::where('id', $id)->first();
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        }

        return $this->sendError(null, 'Data not found', 500);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul_admin' => ['nullable', 'string', 'max:255'],
            'contoh_pertanyaan' => ['nullable', 'string', 'max:255'],
            'kata_kunci' => ['required', 'string'],
            'tipe_pencocokan' => ['required', 'in:contains,exact'],
            'jawaban' => ['required', 'string'],
            'prioritas' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = BahariAiCustomAnswer::where('id', $id)->first();
        if (!$table) {
            return $this->sendError(null, 'Data not found', 500);
        }

        $table->judul_admin = $request->judul_admin;
        $table->contoh_pertanyaan = $request->contoh_pertanyaan;
        $table->kata_kunci = $request->kata_kunci;
        $table->tipe_pencocokan = $request->tipe_pencocokan;
        $table->jawaban = $request->jawaban;
        $table->prioritas = $request->prioritas ?? 0;
        $table->is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $table->is_active = $table->is_active ?? false;

        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        }

        return $this->sendError(null, 'Data failed to update', 500);
    }

    public function destroy($id)
    {
        $table = BahariAiCustomAnswer::where('id', $id)->first();
        if (!$table) {
            return $this->sendError(null, 'Data not found', 500);
        }

        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        }

        return $this->sendError(null, 'Data failed to delete', 500);
    }
}
