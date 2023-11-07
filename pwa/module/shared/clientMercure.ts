import config from "~/module/shared/config";

export function clientMercure(topic: string): EventSource {
    const url = new URL(config.apiUrl + '/.well-known/mercure');
    url.searchParams.append('topic', topic);

    return new EventSource(url);
}
