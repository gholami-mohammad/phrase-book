import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Pagination } from '../components/pagination/pagination-model';
import { SaveResponse, MessageResponse } from '../models/response-models';
import { Word } from '../models/word';

@Injectable({
  providedIn: 'root'
})
export class WordService {

  constructor(private http: HttpClient) { }

  index(page: number, perPage: number) {
    return this.http.get<Pagination<Word>>('/api/words', {params: new HttpParams().set('page', page).set('per_page', perPage)});
  }

  save(word: Word) {
    const path = '/api/words' + (word.id ? `/${word.id}` : '');
    return this.http.post<SaveResponse<Word>>(path, word);
  }

  delete(wordID: number) {
    const path = `/api/words/${wordID}`;
    return this.http.delete<MessageResponse>(path);
  }
}
