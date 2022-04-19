<h1 class="main-heading">Форма <?= !isset($data['users_diagnoses_id']) ? 'добаления' : 'редактирования' ?>  случая</h1>
<form class="" action="<?= $data['action_url']; ?>" method="post">
  <div class="row g-3">
    <div class="col-sm">
      <select class="form-select form-select-lg" name="user_id" aria-label="Выберите пациента" required>
        <?php if (isset($data['users_diagnoses_id'])): ?>
          <option value="<?= $data['user_diagnose_by_id']['user_id'] ?>"><?= $data['user_diagnose_by_id']['name'] ?></option>
        <?php else: ?>
          <option value="" selected>Выберите пациента</option>
          <?php foreach ($data['users'] as $user): ?>
          <option value="<?= $user['id'] ?>"><?= $user['patient'] ?></option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
    <div class="col-sm">
      <input type="hidden" name="id" value="<?= $data['user_diagnose_by_id']['id'] ?? '' ?>">
      <input type="text" id="datepicker" class="form-control form-control-lg" name="date_opening" placeholder="Выберите дату" value="<?= isset($data['users_diagnoses_id']) ? $data['user_diagnose_by_id']['date_opening'] : '' ?>" required>
    </div>
    <div class="col-sm">
      <select class="form-select form-select-lg" name="user_diagnose" aria-label="Выберите диагноз">
        <?php if (isset($data['users_diagnoses_id']) && !empty($data['user_diagnose_by_id']['user_diagnose'])): ?>
        <option value="<?= $data['user_diagnose_by_id']['user_diagnose'] ?>" selected><?= $data['user_diagnose_by_id']['description'] ?></option>
        <?php endif; ?>
        <option value="" <?= !isset($data['users_diagnoses_id']) || !empty($data['users_diagnoses_id']['user_diagnose']) ? 'selected' : '' ?>>Выберите диагноз</option>
        <?php foreach ($data['diagnoses'] as $diagnose): ?>
        <option value="<?= $diagnose['id'] ?>"><?= $diagnose['description'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-margin">Отправить</button>
</form>

<script>

  $.datepicker.regional['ru'] = {

    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    dateFormat: 'yy-mm-dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''

  };

  $.datepicker.setDefaults($.datepicker.regional['ru']);

  $(function(){

    $("#datepicker").datepicker();

  });
</script>