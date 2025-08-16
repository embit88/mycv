import "@/app/globals.css";
import React from "react";
import {headers} from "next/headers";
import appConfig from "@/appConfig";
import {getTranslations} from "@/utils/functions";

export async function generateMetadata() {
    const locale = (await headers()).get('x-current-locale') ?? appConfig.defaultLocale;
    const translation = await getTranslations(locale);

    return {
        title: translation.title.error,
        description: translation.title.error
    };
}

export default async function NotFound() {
    const locale = (await headers()).get('x-current-locale') ?? appConfig.defaultLocale;
    const translation = await getTranslations(locale);

    return (
        <div className="flex flex-col items-center justify-center h-screen">
            <h1 className="text-4xl mb-5 text-secondary">{translation.title.error}</h1>
        </div>
    );
}
