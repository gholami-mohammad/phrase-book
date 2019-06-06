import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { IError } from 'src/app/models/error';
import { ErrorHandlerService } from 'src/app/services/error-handler.service';
import { SnackerService } from 'src/app/services/snacker.service';
import { TranslateService } from 'src/app/services/translate.service';
import { WordService } from 'src/app/services/word.service';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: 'app-word-translation-form',
  templateUrl: './word-translation-form.component.html',
  styleUrls: ['./word-translation-form.component.scss']
})
export class WordTranslationFormComponent implements OnInit {

  @Input() basicInfo: any = {};
  @Input() word: any = {};
  @Input() translation: any = {};
  
  @Output() translationSaved: EventEmitter<any> = new EventEmitter();

  loading = false;
  errors: IError = {};

  constructor(
    private errHandler: ErrorHandlerService,
    private snacker: SnackerService,
    private translateService: TranslateService,
    private wordService: WordService) { }

  ngOnInit() {
    this.translateService.getBasicInfo().subscribe(res => {
      this.basicInfo = res;
      this.loadLastLanguage();
    });
  }

  handleHttpError(err: HttpErrorResponse) {
    this.loading = false;
    this.errors = this.errHandler.HandleResponseErrors(err);
    this.snacker.error(this.errors);
  }

  save() {
    this.translation.word_id = this.word.id;
    this.loading = true;
    this.translateService.save(this.translation).subscribe(res => {
      this.loading = false;
      this.resetModel();
      this.translationSaved.emit(res);
      this.snacker.success('Translation saved!');
    }, err => {
      this.handleHttpError(err);
    });
  }

  setLastLanguage() {
    localStorage.setItem('last_translation_language', this.translation.language_alpha2code);
  }
  
  loadLastLanguage() {
    this.translation.language_alpha2code = localStorage.getItem('last_translation_language');
  }

  resetModel() {
    this.translation = {};
    this.loadLastLanguage();
  }
}
