import React from 'react';
import {getTranslations} from "@/utils/functions";
import appConfig from "@/appConfig";
import Link from "next/link";

interface Experience {
    name: string;
    profession: string;
    site?: string;
    data: string;
    text: string;
}

export async function generateMetadata({ params }: { params: Promise<{ locale: string }> }) {
    const translation = await getTranslations((await params).locale);

    return {
        title: translation.seo.meta_title,
        description: translation.seo.meta_description,
    };
}

export default async function Home({params}: { params: Promise<{ locale: string }> }) {
    const translation = await getTranslations((await params).locale);
    const experiences: Experience[] = Object.values(translation.experiences) as Experience[];

    return (
        <div className="bg-gray-100">
            <div className="container mx-auto py-8">
                <div className="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                    <div className="col-span-4 sm:col-span-3">
                        <div className="bg-white shadow rounded-lg p-6">
                            <div className="flex flex-col items-center">
                                {appConfig.image ? (
                                    <img src={appConfig.image}
                                         className="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0" alt="" />
                                ) : null}
                                <h1 className="text-xl text-gray-700 uppercase font-bold tracking-wider">{translation.info.name}</h1>
                                <p className="text-gray-600 text-sm m-2">{translation.info.profession}</p>
                                <a href={`mailto:${appConfig.email}`}
                                   className="text-gray-800 m-2 underline">{appConfig.email}</a>
                                <a href={`tel:${appConfig.phone}`}
                                   className="text-gray-800 m-2 underline">{appConfig.phone}</a>
                                <div className="flex justify-center items-center gap-5 mt-4">
                                    <a className="text-gray-700 hover:opacity-80" href={appConfig.github} target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16" fill="currentColor">
                                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54
                                                      2.29 6.53 5.47 7.59.4.07.55-.17.55-.38
                                                      0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52
                                                      -.01-.53.63-.01 1.08.58 1.23.82.72 1.21
                                                      1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78
                                                      -.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15
                                                      -.08-.2-.36-1.02.08-2.12 0 0 .67-.21
                                                      2.2.82a7.7 7.7 0 0 1 2-.27c.68 0
                                                      1.36.09 2 .27 1.53-1.04 2.2-.82
                                                      2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82
                                                      1.27.82 2.15 0 3.07-1.87 3.75-3.65
                                                      3.95.29.25.54.73.54 1.48 0 1.07-.01
                                                      1.93-.01 2.2 0 .21.15.46.55.38A8.013
                                                      8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                        </svg>
                                    </a>
                                    <a className="text-gray-700 hover:opacity-80" href={appConfig.telegram} target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 240 240">
                                            <circle cx="120" cy="120" r="120" fill="#37aee2"/>
                                            <path fill="#c8daea" d="M98 175c-3.94 0-3.28-1.49-4.65-5.24l-11.2-36.76 87.62-51.9"/>
                                            <path fill="#a9c9dd" d="M98 175c3 0 4.32-1.38 6-3l16-15.55-19.96-12"/>
                                            <path fill="#f6fbfe" d="M100 144.45 152.2 183c5.94 3.28 10.26 1.58 11.74-5.5l21.3-100.2c2.18-8.73-3.33-12.7-9.06-10.1L52 121.24c-8.6 3.45-8.55 8.23-1.57 10.37l31.24 9.74 72.4-45.6c3.42-2.07 6.55-.96 3.98 1.32"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <hr className="my-6 border-t border-gray-300"/>
                            <div className="flex flex-col text-center">
                                <span
                                    className="text-gray-700 uppercase font-bold tracking-wider mb-2">{translation.title.skills}</span>
                                <ul>
                                    {translation.skills.map((skill: string) => (
                                        <li key={skill} className="mb-2">
                                            {skill}
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="col-span-4 sm:col-span-9">
                        <div className="relative">
                            <div className="flex space-x-4 right-5 top-3 absolute">
                                {appConfig.locales.length > 0 ? (
                                    appConfig.locales.map((locale, index) => (
                                        <Link
                                            href={`/${locale}`}
                                            key={`select-lang-${index}`}
                                            className="text-xs font-semibold flex justify-center"
                                        >
                                            {locale.toUpperCase()}
                                        </Link>
                                    ))
                                ) : null}
                            </div>
                        </div>
                        <div className="bg-white shadow rounded-lg p-6">
                            <h2 className="text-xl font-bold mb-4">{translation.title.about_me}</h2>
                            <p className="text-gray-700">
                                {translation.text.about_me}
                            </p>
                            <h2 className="text-xl font-bold mt-6 mb-4">{translation.title.experience}</h2>
                            {experiences.map((experience, index) => (
                                <div key={index} className="mb-6 mt-10">
                                    <div className="flex justify-between flex-wrap gap-2 w-full">
                                       <span className="text-gray-700 font-bold">
                                            {experience.profession} - {experience.name}{" "}
                                              {experience.site && (
                                                  <>
                                                      (<a href={experience.site} target="_blank" rel="noreferrer nofollow"
                                                          className="text-gray-700 text-sm underline">
                                                      {experience.site}
                                                  </a>)
                                                  </>
                                              )}
                                       </span>
                                        <p>
                                            <span className="text-gray-700">{experience.data}</span>
                                        </p>
                                    </div>
                                    <p className="mt-2">{experience.text}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
