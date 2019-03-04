import axios from 'axios';

export const API_BASE = '/api';

export default class ApiService
{
	public static getRating(nodeUuid: string, lang: string)
	{
		return axios.get(`${API_BASE}/like/likes/${nodeUuid}/${lang}`);
	}

	public static postRating(nodeUuid: string, lang: string, rating: number)
	{
		return axios.post(`${API_BASE}/like/likes/${nodeUuid}/${lang}`, { rating });
	}
}
