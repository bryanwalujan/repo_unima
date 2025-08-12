<?php
namespace App\Services;

use App\Models\Dosen;
use App\Models\Penelitian;
use Illuminate\Support\Facades\Log;

class RecommendationService
{
  // app/Services/RecommendationService.php
public function getCollaborationRecommendations($dosenId)
{
    $dosen = Dosen::with(['penelitians'])->findOrFail($dosenId);
    $allDosens = Dosen::with(['penelitians', 'pengabdians'])->where('id', '!=', $dosenId)->get();

    if ($dosen->penelitians->isEmpty()) {
        return [
            'message' => 'Tidak ada data penelitian untuk menghasilkan rekomendasi.',
            'recommendations' => []
        ];
    }

    $recommendations = [];
    $currentDosenKeywords = [];

    foreach ($dosen->penelitians as $penelitian) {
        $keywords = is_array($penelitian->keywords) ? $penelitian->keywords : json_decode($penelitian->keywords, true) ?? explode(',', $penelitian->keywords);
        $currentDosenKeywords = array_merge($currentDosenKeywords, array_map('trim', $keywords));
    }
    $currentDosenKeywords = array_unique($currentDosenKeywords);

    foreach ($allDosens as $otherDosen) {
        $score = 0;
        $matchedKeywords = [];
        $otherPenelitians = [];
        $otherPengabdians = [];

        foreach ($otherDosen->penelitians as $penelitian) {
            $otherKeywords = is_array($penelitian->keywords) ? $penelitian->keywords : json_decode($penelitian->keywords, true) ?? explode(',', $penelitian->keywords);
            $otherKeywords = array_map('trim', $otherKeywords);
            $commonKeywords = array_intersect($currentDosenKeywords, $otherKeywords);
            $score += count($commonKeywords);
            $matchedKeywords = array_merge($matchedKeywords, $commonKeywords);
            $otherPenelitians[] = $penelitian->judul_penelitian;
        }

        foreach ($otherDosen->pengabdians as $pengabdian) {
            $otherPengabdians[] = $pengabdian->judul_pengabdian;
        }

        if ($score > 0) {
            $recommendations[] = [
                'dosen_id' => $otherDosen->id,
                'nama' => $otherDosen->nama,
                'nidn' => $otherDosen->nidn,
                'score' => $score,
                'matched_keywords' => array_unique($matchedKeywords),
                'penelitians' => $otherPenelitians,
                'pengabdians' => $otherPengabdians
            ];
        }
    }

    usort($recommendations, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    return [
        'message' => 'Rekomendasi kolaborasi berhasil dihasilkan.',
        'recommendations' => array_slice($recommendations, 0, 5)
    ];
}
}