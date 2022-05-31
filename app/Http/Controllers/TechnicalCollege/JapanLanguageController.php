<?php

namespace App\Http\Controllers\TechnicalCollege;

use App\Http\Controllers\Controller;
use App\Http\Requests\JapaneseLanguageFormSaveRequest;
use App\Models\JapaneseLanguage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class JapanLanguageController extends Controller
{
    /**
     * @return Response
     */
    public function showRegistrationForm(): Response
    {
        return Inertia::render("TechnicalCollege/RegistrationForm");
    }

    /**
     * @param JapaneseLanguageFormSaveRequest $request
     * @return JsonResponse
     */
    public function saveApplication(JapaneseLanguageFormSaveRequest $request): JsonResponse
    {
        $japanese_language = new JapaneseLanguage();
        $japanese_language->name = $request->get("name");
        $japanese_language->email = $request->get("email");
        $japanese_language->age = $request->get("age");
        $japanese_language->phone = $request->get("phone");
        $japanese_language->address = $request->get("address");

        $japanese_language->save();

        return new JsonResponse("Success!");
    }
}
