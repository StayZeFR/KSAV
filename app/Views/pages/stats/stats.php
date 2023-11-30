<?= $this->extend("_pattern") ?>

<?= $this->section("assets") ?>
<script src="<?= base_url("resources/libs/chart/chart.js") ?>"></script>
<script src="<?= base_url("resources/js/stats/stats.js") ?>"></script>

<script>
    const avgNotesServices = <?= json_encode($avgNotesServices) ?>;
    const avgNotesTravels = <?= json_encode($avgNotesTravels) ?>;
</script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>

<?= $this->include("templates/navigation") ?>

<div class="slds-box" style="width: 95% !important; background-color: white; margin: auto; margin-top: 20px;">
    <div style="display: flex; flex-direction: row; justify-content: space-between;">
        <h2 class="slds-text-heading_medium">Statistiques</h2>
    </div>
    <hr style="margin: 30px 0;">
    <div id="charts">
        <div class="slds-grid slds-wrap" style="padding: 20px;">
            <div class="slds-col slds-size_1-of-2">
                <div class="slds-box" style="height: 400px;">
                    <canvas id="chart-1"></canvas>
                </div>
            </div>
            <div class="slds-col slds-size_1-of-2">
                <div class="slds-box" style="height: 400px;">
                    <canvas id="chart-2"></canvas>
                </div>
            </div>
            <div class="slds-col slds-size_1-of-1" style="margin-top: 20px;">
                <div class="slds-form-element">
                    <label class="slds-form-element__label" for="select-id_travel">Voyage</label>
                    <div class="slds-form-element__control">
                        <div class="slds-select_container">
                            <select class="slds-select" id="select-id_travel" onchange="showStatsAverageNotesServicesByTravel()">
                                <?php
                                foreach ($travels as $travel) {
                                    echo "<option value='{$travel["MODELEVOYAGE_ID"]}'>{$travel["MODELEVOYAGE_NOM"]}</option>";
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="slds-box" style="height: 400px;">
                    <canvas id="chart-3"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>