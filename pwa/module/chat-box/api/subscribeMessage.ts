import {clientMercure} from "~/module/shared/clientMercure";

export function subscribeMessage(): EventSource {
    return clientMercure('chat_box');
}
