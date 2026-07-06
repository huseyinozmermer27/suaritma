<?php
function renderReview($name, $date, $comment, $type) {
    $icon = '<i class="fab fa-google text-blue-500 text-lg"></i>';
    $imgHtml = '<div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center"><i class="fas fa-user text-gray-500"></i></div>';

    if ($type === 'judge') {
        $icon = '<img src="https://judge.me/assets/favicon.ico" class="w-5 h-5">';
    }

    echo '
    <div class="review-item bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 h-[400px] flex flex-col" data-type="'.$type.'">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                '.$imgHtml.'
                <div>
                    <h5 class="font-bold text-gray-900 text-sm">'.$name.'</h5>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">'.$date.'</p>
                </div>
            </div>
            <div class="flex-shrink-0">'.$icon.'</div>
        </div>
        <div class="text-orange-400 text-[10px] mb-4"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
        <p class="text-gray-600 text-sm italic flex-grow mb-6 leading-relaxed">"'.$comment.'"</p>
        <div class="w-full h-24 bg-gray-50 rounded-2xl flex items-center justify-center text-[10px] text-gray-400 font-bold uppercase tracking-widest border border-dashed border-gray-200">Görsel Bekleniyor</div>
    </div>';
}
?>