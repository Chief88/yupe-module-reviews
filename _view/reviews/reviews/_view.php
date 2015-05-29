<?php $modulo = $index % 3;

switch($modulo){
    case 0:
        $classF = 'f1';
        break;
    case 1:
        $classF = 'f2';
        break;
    case 2:
        $classF = 'f3';
        break;
    default:
        $classF = 'f1';
}?>

<li>
    <div class="image photoframe <?= $classF; ?>">
        <img src="<?= $data->getImageUrl(320, 222); ?>" alt="<?= $data->organisation; ?>" />
    </div>
    <div class="title withdate">
        <?= $data->name; ?>
        <div class="date"><?= $data->date; ?></div>
    </div>
    <div class="cut"><?= $data->message; ?></div>
</li>